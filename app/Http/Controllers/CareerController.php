<?php

namespace App\Http\Controllers;

use App\Models\CareerOpening;
use App\Models\CareerSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

class CareerController extends Controller
{
    public function show(string $track)
    {
        abort_unless(in_array($track, ['attorneys', 'professional-staff']), 404);

        $s = CareerSetting::firstOrCreate(['id' => 1], [
            'attorney_overview' => 'Join a collaborative legal team where thoughtful counsel and client relationships come first.',
            'attorney_advancement' => 'Develop your practice with mentorship, meaningful responsibility and direct client engagement.',
            'staff_overview' => 'Bring your skills to a collaborative team where every contribution supports exceptional client service.',
            'staff_advancement' => 'Build skills, take ownership and grow your career in a supportive environment.',
        ]);

        $career = [
            'title' => $track === 'attorneys' ? 'Careers: Attorneys' : 'Careers: Professional Staff',
            'image' => $track === 'attorneys' ? 'discus-business-needs.jpg' : 'professsional-services.jpg',
            'image_alt' => 'Niaz Law team at work',
            'overview' => $track === 'attorneys' ? $s->attorney_overview : $s->staff_overview,
            'advancement' => $track === 'attorneys' ? $s->attorney_advancement : $s->staff_advancement,
            'openings' => CareerOpening::where('track', $track)->where('active', true)->get(),
        ];

        return view('career-detail', compact('career', 'track'));
    }

    public function apply(Request $r)
    {
        $d = $r->validate([
            'name' => 'required|string|max:120',
            'email' => 'required|email',
            'phone' => 'required|string|max:40',
            'opening' => 'required|string|max:160',
            'resume' => 'nullable|file|mimes:pdf|max:10240',
            'message' => 'nullable|string|max:2000',
        ]);

        $resumePath = null;
        $resumeName = null;

        if ($r->hasFile('resume') && $r->file('resume')->isValid()) {
            $file = $r->file('resume');
            $resumeName = $file->getClientOriginalName();
            $uploadDir = public_path('uploads/resumes');
            if (!file_exists($uploadDir)) {
                mkdir($uploadDir, 0755, true);
            }
            $savedName = time() . '_' . preg_replace('/[^a-zA-Z0-9_\.-]/', '', $resumeName);
            $file->move($uploadDir, $savedName);
            $resumePath = $uploadDir . '/' . $savedName;
        }

        $settings = CareerSetting::first();
        $to = $settings && $settings->application_email ? $settings->application_email : config('services.contact_inquiries.recipient');

        try {
            Mail::send([], [], function ($m) use ($to, $d, $resumePath, $resumeName) {
                $body = "Career Application Details:\n\n"
                      . "Role / Opening: {$d['opening']}\n"
                      . "Full Name: {$d['name']}\n"
                      . "Email: {$d['email']}\n"
                      . "Phone: {$d['phone']}\n\n"
                      . "Message / Cover Note:\n" . ($d['message'] ?? 'None provided') . "\n";

                if ($resumeName) {
                    $body .= "\nAttached Resume: {$resumeName}\n";
                }

                $m->to($to)
                  ->replyTo($d['email'])
                  ->subject('Career application: ' . $d['opening'])
                  ->setBody($body, 'text/plain');

                if ($resumePath && file_exists($resumePath)) {
                    $m->attach($resumePath, [
                        'as' => $resumeName,
                        'mime' => 'application/pdf',
                    ]);
                }
            });
        } catch (\Exception $e) {
            Log::error('Career application email failed.', ['error' => $e->getMessage(), 'opening' => $d['opening']]);
            if ($r->ajax() || $r->wantsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Application could not be emailed right now. Please use Email your CV or try again later.'
                ], 422);
            }
            return back()->withInput()->withErrors(['email' => 'Application could not be emailed right now. Please use Email your CV or try again later.']);
        }

        $successMsg = 'Thank you! Your request is being reviewed by our team, and we will get back to you soon.';

        if ($r->ajax() || $r->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => $successMsg
            ]);
        }

        return back()->with('success', $successMsg);
    }
}
