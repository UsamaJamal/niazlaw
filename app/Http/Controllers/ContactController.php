<?php

namespace App\Http\Controllers;

use App\Models\ContactSetting;
use App\Models\Capability;
use Illuminate\Support\Facades\Log;

class ContactController extends Controller
{
    public function index()
    {
        return view('contact-us', [
            'contactSettings' => ContactSetting::first(),
            'capabilities' => Capability::orderBy('title')->get(),
        ]);
    }

    public function submit(\Illuminate\Http\Request $request)
    {
        $data = $request->validate([
            'first_name' => ['required', 'string', 'max:50', 'regex:/^[\\pL\\s\'-]+$/u'],
            'last_name' => ['required', 'string', 'max:50', 'regex:/^[\\pL\\s\'-]+$/u'],
            'email' => 'required|email',
            'phone' => 'required|string|max:20',
            'company' => 'nullable|string|max:100',
            'practice' => 'required|string',
            'message' => 'required|string',
        ]);

        $contactEmail = config('services.contact_inquiries.recipient');

        try {
            \Illuminate\Support\Facades\Mail::to($contactEmail)->send(new \App\Mail\ContactInquiry($data));
        } catch (\Exception $e) {
            Log::error('Contact Us form email failed.', [
                'recipient' => $contactEmail,
                'exception' => $e->getMessage(),
            ]);
            if ($request->ajax() || $request->wantsJson()) {
                return response()->json(['message' => 'Error sending email. Please check your SMTP settings in .env file.'], 500);
            }
            return redirect()->back()->withErrors(['email' => 'Error sending email. Please check your SMTP settings.']);
        }

        if ($request->ajax() || $request->wantsJson()) {
            return response()->json(['message' => 'Your inquiry has been sent successfully. We will get back to you soon.']);
        }

        return redirect()->back()->with('success', 'Your inquiry has been sent successfully. We will get back to you soon.');
    }

    public function quickSubmit(\Illuminate\Http\Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:100', 'regex:/^[\\pL\\s\'-]+$/u'],
            'email' => 'required|email',
            'subject' => 'nullable|string|max:150',
            'message' => 'required|string',
        ]);

        $contactEmail = config('services.contact_inquiries.recipient');

        try {
            \Illuminate\Support\Facades\Mail::to($contactEmail)->send(new \App\Mail\QuickInquiry($data));
        } catch (\Exception $e) {
            Log::error('Home Page quick-contact email failed.', [
                'recipient' => $contactEmail,
                'exception' => $e->getMessage(),
            ]);
            if ($request->ajax() || $request->wantsJson()) {
                return response()->json(['message' => 'Error sending email. Please check your SMTP settings in .env file.'], 500);
            }
            return redirect()->back()->withErrors(['email' => 'Error sending email. Please check your SMTP settings.']);
        }

        if ($request->ajax() || $request->wantsJson()) {
            return response()->json(['message' => 'Thank you! Your message has been sent successfully.']);
        }
        return redirect()->back()->with('success', 'Thank you! Your message has been sent successfully.');
    }
}
