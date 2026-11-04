<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CareerOpening;
use App\Models\CareerSetting;
use Illuminate\Http\Request;

class CareerController extends Controller
{
    public function edit(Request $request)
    {
        $track = $request->query('track');
        if ($track && !in_array($track, ['attorneys', 'professional-staff'])) {
            $track = null;
        }

        $openingsQuery = CareerOpening::latest();
        if ($track) {
            $openingsQuery->where('track', $track);
        }

        return view('admin.careers', [
            'settings' => CareerSetting::firstOrCreate(['id' => 1]),
            'openings' => $openingsQuery->get(),
            'currentTrack' => $track,
        ]);
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'attorney_overview' => 'nullable|string',
            'attorney_advancement' => 'nullable|string',
            'staff_overview' => 'nullable|string',
            'staff_advancement' => 'nullable|string',
            'application_email' => 'nullable|email',
        ]);

        CareerSetting::updateOrCreate(['id' => 1], $validated);

        return back()->with('success', 'Career content saved.');
    }

    public function uploadImage(Request $request)
    {
        $request->validate([
            'file' => 'required|image|mimes:jpeg,png,jpg,gif,webp,svg|max:6144',
        ]);

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $uploadPath = public_path('images/uploads');
            if (!file_exists($uploadPath)) {
                mkdir($uploadPath, 0755, true);
            }
            $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move($uploadPath, $filename);

            return response()->json([
                'location' => asset('images/uploads/' . $filename),
            ]);
        }

        return response()->json(['error' => 'No image uploaded.'], 400);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'track' => 'required|in:attorneys,professional-staff',
            'title' => 'required|string|max:160',
            'location' => 'required|string|max:160',
            'description' => 'nullable|string',
        ]);

        CareerOpening::create($validated);

        return back()->with('success', 'Opening added.');
    }

    public function openingEdit(CareerOpening $opening)
    {
        return view('admin.career-opening-edit', compact('opening'));
    }

    public function openingUpdate(Request $request, CareerOpening $opening)
    {
        $validated = $request->validate([
            'track' => 'required|in:attorneys,professional-staff',
            'title' => 'required|string|max:160',
            'location' => 'required|string|max:160',
            'description' => 'nullable|string',
            'active' => 'nullable|boolean',
        ]);

        $opening->update($validated);

        return redirect()->route('admin.careers.edit', ['track' => $opening->track])->with('success', 'Opening updated.');
    }

    public function destroy(CareerOpening $opening)
    {
        $track = $opening->track;
        $opening->delete();

        return redirect()->route('admin.careers.edit', ['track' => $track])->with('success', 'Opening deleted.');
    }
}
