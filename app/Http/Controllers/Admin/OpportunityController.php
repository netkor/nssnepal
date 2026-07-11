<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Opportunity;
use Illuminate\Http\Request;

class OpportunityController extends Controller
{
    public function index()
    {
        $opportunities = Opportunity::orderByDesc('created_at')->paginate(15);
        return view('admin.opportunities.index', compact('opportunities'));
    }

    public function create()
    {
        return view('admin.opportunities.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'type' => 'required|in:thesis_grant,volunteer,internship',
            'content' => 'required|string',
            'is_active' => 'nullable',
        ]);

        $validated['is_active'] = $request->has('is_active');

        Opportunity::create($validated);

        return redirect()->route('admin.opportunities.index')->with('success', 'Opportunity created successfully.');
    }

    public function edit(Opportunity $opportunity)
    {
        return view('admin.opportunities.edit', compact('opportunity'));
    }

    public function update(Request $request, Opportunity $opportunity)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'type' => 'required|in:thesis_grant,volunteer,internship',
            'content' => 'required|string',
            'is_active' => 'nullable',
        ]);

        $validated['is_active'] = $request->has('is_active');

        $opportunity->update($validated);

        return redirect()->route('admin.opportunities.index')->with('success', 'Opportunity updated successfully.');
    }

    public function destroy(Opportunity $opportunity)
    {
        $opportunity->delete();
        return redirect()->route('admin.opportunities.index')->with('success', 'Opportunity deleted successfully.');
    }
}
