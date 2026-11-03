<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AttorneyTaxonomy;
use Illuminate\Http\Request;

class AttorneyTitleController extends Controller
{
    public function index()
    {
        return view('admin.attorney-titles', [
            'titles' => AttorneyTaxonomy::where('type', 'title')->orderBy('name')->get(),
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate(['name' => ['required', 'string', 'max:120']]);
        AttorneyTaxonomy::firstOrCreate(['type' => 'title', 'name' => $data['name']]);

        return back()->with('success', 'Title added successfully.');
    }

    public function destroy(AttorneyTaxonomy $title)
    {
        abort_unless($title->type === 'title', 404);
        $title->delete();

        return back()->with('success', 'Title removed successfully.');
    }
}
