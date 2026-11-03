<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Attorney;
use App\Models\AttorneyTaxonomy;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class AttorneyTaxonomyController extends Controller
{
    public function index()
    {
        return view('admin.attorney-taxonomies', [
            'practices' => AttorneyTaxonomy::where('type', 'practice')->orderBy('name')->get(),
            'industries' => AttorneyTaxonomy::where('type', 'industry')->orderBy('name')->get(),
            'locations' => AttorneyTaxonomy::where('type', 'location')->orderBy('name')->get(),
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate(['type' => ['required', 'in:practice,industry,location'], 'name' => ['required', 'string', 'max:120']]);
        AttorneyTaxonomy::firstOrCreate(['type' => $data['type'], 'name' => $data['name']]);
        return back()->with('success', ucfirst($data['type']) . ' added.');
    }

    public function update(Request $request, AttorneyTaxonomy $taxonomy)
    {
        $data = $request->validate(['name' => ['required', 'string', 'max:120', Rule::unique('attorney_taxonomies', 'name')->where('type', $taxonomy->type)->ignore($taxonomy->id)]]);
        $previousName = $taxonomy->name;
        $taxonomy->update($data);
        $this->updateAttorneyOptionValues($taxonomy->type, $previousName, $taxonomy->name);
        return back()->with('success', 'Option updated.');
    }

    public function destroy(AttorneyTaxonomy $taxonomy)
    {
        abort_unless(in_array($taxonomy->type, ['practice', 'industry', 'location'], true), 404);
        $type = $taxonomy->type;
        $name = $taxonomy->name;
        $taxonomy->delete();
        $this->updateAttorneyOptionValues($type, $name);
        return back()->with('success', 'Option deleted.');
    }

    private function updateAttorneyOptionValues(string $type, string $oldName, ?string $newName = null): void
    {
        Attorney::where($type, 'like', '%' . $oldName . '%')->each(function (Attorney $attorney) use ($type, $oldName, $newName) {
            $values = array_map('trim', explode(',', $attorney->{$type}));

            if (!in_array($oldName, $values, true)) {
                return;
            }

            $values = $newName === null
                ? array_filter($values, fn ($value) => $value !== $oldName)
                : array_map(fn ($value) => $value === $oldName ? $newName : $value, $values);

            $attorney->update([$type => implode(', ', array_values(array_unique($values)))]);
        });
    }

}
