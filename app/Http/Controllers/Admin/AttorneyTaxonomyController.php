<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AttorneyTaxonomy;
use Illuminate\Http\Request;

class AttorneyTaxonomyController extends Controller
{
    public function index()
    {
        $this->seedDefaults();
        return view('admin.attorney-taxonomies', [
            'practices' => AttorneyTaxonomy::where('type', 'practice')->orderBy('name')->get(),
            'industries' => AttorneyTaxonomy::where('type', 'industry')->orderBy('name')->get(),
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate(['type' => ['required', 'in:practice,industry'], 'name' => ['required', 'string', 'max:120']]);
        AttorneyTaxonomy::firstOrCreate(['type' => $data['type'], 'name' => $data['name']]);
        return back()->with('success', ucfirst($data['type']) . ' added.');
    }

    public function update(Request $request, AttorneyTaxonomy $taxonomy)
    {
        $data = $request->validate(['name' => ['required', 'string', 'max:120']]);
        $taxonomy->update($data);
        return back()->with('success', 'Option updated.');
    }

    public function destroy(AttorneyTaxonomy $taxonomy)
    {
        abort_unless(in_array($taxonomy->type, ['practice', 'industry'], true), 404);
        $taxonomy->delete();
        return back()->with('success', 'Option deleted.');
    }

    private function seedDefaults(): void
    {
        $defaults = [
            'practice' => ['Commercial Transactions','Infrastructure & Projects','Procurement & Contracting','Aviation','Commercial Risk','International Business','Corporate Transactions & Governance','Commercial Operations & Strategic Sourcing','Infrastructure & Construction','Aviation & Transportation','Real Estate Transactions'],
            'industry' => ['Aviation','Energy & Infrastructure','Technology','Healthcare & Life Sciences','Real Estate & Construction'],
        ];
        foreach ($defaults as $type => $names) foreach ($names as $name) AttorneyTaxonomy::firstOrCreate(['type' => $type, 'name' => $name]);
    }
}
