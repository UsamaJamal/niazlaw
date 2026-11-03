<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Attorney;
use App\Models\Capability;
use App\Models\AttorneyTaxonomy;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use Illuminate\Validation\Rule;

class AttorneyController extends Controller
{
    public function create()
    {
        return view('admin.attorneys.create', ['attorneys' => Attorney::latest()->get(), 'capabilities' => Capability::orderBy('title')->get(), 'titles' => AttorneyTaxonomy::where('type', 'title')->orderBy('name')->pluck('name')]);
    }

    public function details()
    {
        return view('admin.attorneys.details', ['attorneys' => Attorney::latest()->get()]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'photo' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:5120'],
            'name' => ['required', 'string', 'max:120'],
            'practice' => ['required', 'array', 'min:1'],
            'practice.*' => ['string', 'max:120'],
            'practice_custom' => ['nullable', 'string', 'max:120'],
            'industry' => ['required', 'array', 'min:1'],
            'industry.*' => ['string', 'max:120'],
            'industry_custom' => ['nullable', 'string', 'max:120'],
            'location' => ['required', 'array', 'min:1'],
            'location.*' => ['string', 'max:120'],
            'title' => ['required', 'string', 'max:120'],
            'designation' => ['nullable', 'string', 'max:255'],
            'capabilities' => ['nullable', 'array'],
            'capabilities.*' => ['integer', 'exists:capabilities,id'],
            'meta_title' => ['nullable', 'string', 'max:255'],
            'meta_description' => ['nullable', 'string'],
            'meta_keywords' => ['nullable', 'string'],
            'robots' => ['nullable', 'string', 'max:100'],
        ]);

        if (!empty($data['practice_custom'])) $data['practice'][] = $data['practice_custom'];
        if (!empty($data['industry_custom'])) $data['industry'][] = $data['industry_custom'];
        $data['practice'] = implode(', ', $data['practice']);
        $data['industry'] = implode(', ', $data['industry']);
        unset($data['practice_custom'], $data['industry_custom']);
        $data['location'] = implode(', ', $data['location']);
        $data['email'] = '';
        $data['phone'] = '';

        if ($request->hasFile('photo')) {
            $photo = $request->file('photo');
            $file = 'attorney-' . Str::uuid() . '.' . $photo->getClientOriginalExtension();
            $photo->move(public_path('images'), $file);
            $data['photo'] = $file;
        }

        $data['slug'] = Str::slug($data['name']) . '-' . Str::lower(Str::random(6));
        $attorney = Attorney::create($data);
        $attorney->capabilities()->sync($request->input('capabilities', []));

        return back()->with('success', 'Attorney added successfully.');
    }

    public function edit(Attorney $attorney)
    {
        return view('admin.attorneys.edit', ['attorney' => $attorney, 'capabilities' => Capability::orderBy('title')->get(), 'titles' => AttorneyTaxonomy::where('type', 'title')->orderBy('name')->pluck('name')]);
    }

    public function update(Request $request, Attorney $attorney)
    {
        $data = $request->validate([
            'photo' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:5120'],
            'name' => ['required', 'string', 'max:120'],
            'slug' => ['required', 'string', 'max:140', 'alpha_dash', Rule::unique('attorneys', 'slug')->ignore($attorney->id)],
            'practice' => ['required', 'array', 'min:1'],
            'practice.*' => ['string', 'max:120'],
            'practice_custom' => ['nullable', 'string', 'max:120'],
            'industry' => ['required', 'array', 'min:1'],
            'industry.*' => ['string', 'max:120'],
            'industry_custom' => ['nullable', 'string', 'max:120'],
            'location' => ['required', 'array', 'min:1'],
            'location.*' => ['string', 'max:120'],
            'title' => ['required', 'string', 'max:120'],
            'designation' => ['nullable', 'string', 'max:255'],
            'capabilities' => ['nullable', 'array'],
            'capabilities.*' => ['integer', 'exists:capabilities,id'],
            'email' => ['nullable', 'email', 'max:255'],
            'phone' => ['nullable', 'string', 'max:40'],
            'linkedin_url' => ['nullable', 'url', 'max:255'],
            'profile_pdf' => ['nullable', 'file', 'mimes:pdf'],
            'overview' => ['nullable', 'string'],
            'experience' => ['nullable', 'string'],
            'education' => ['nullable', 'string'],
            'admissions' => ['nullable', 'string'],
            'meta_title' => ['nullable', 'string', 'max:255'],
            'meta_description' => ['nullable', 'string'],
            'meta_keywords' => ['nullable', 'string'],
            'robots' => ['nullable', 'string', 'max:100'],
        ]);

        if (!empty($data['practice_custom'])) $data['practice'][] = $data['practice_custom'];
        if (!empty($data['industry_custom'])) $data['industry'][] = $data['industry_custom'];
        $data['practice'] = implode(', ', $data['practice']);
        $data['industry'] = implode(', ', $data['industry']);
        unset($data['practice_custom'], $data['industry_custom']);
        $data['location'] = implode(', ', $data['location']);
        $data['experience_points'] = null;

        if ($request->hasFile('photo')) {
            $photo = $request->file('photo');
            $file = 'attorney-' . Str::uuid() . '.' . $photo->getClientOriginalExtension();
            $photo->move(public_path('images'), $file);
            $data['photo'] = $file;
        }

        if ($request->hasFile('profile_pdf')) {
            $pdf = $request->file('profile_pdf');
            $directory = public_path('uploads/attorney-pdfs');
            File::ensureDirectoryExists($directory);
            $pdfFile = Str::slug($data['name']) . '-profile.pdf';
            $pdf->move($directory, $pdfFile);
            $data['profile_pdf'] = 'uploads/attorney-pdfs/' . $pdfFile;
        } else {
            unset($data['profile_pdf']);
        }

        unset($data['photo']);
        $attorney->fill($data);
        if (isset($file)) $attorney->photo = $file;
        $attorney->save();
        $attorney->capabilities()->sync($request->input('capabilities', []));

        return redirect()->route('admin.attorneys.create')->with('success', 'Attorney updated successfully.');
    }

    public function destroy(Attorney $attorney)
    {
        $attorney->delete();

        return redirect()->route('admin.attorneys.create')->with('success', 'Attorney deleted successfully.');
    }
}
