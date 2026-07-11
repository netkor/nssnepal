<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TeamMember;
use App\Services\ImageService;
use Illuminate\Http\Request;

class TeamMemberController extends Controller
{
    public function index()
    {
        $team = TeamMember::orderBy('role_type')->orderBy('order')->paginate(15);
        return view('admin.team-members.index', compact('team'));
    }

    public function create()
    {
        return view('admin.team-members.create');
    }

    public function store(Request $request, ImageService $images)
    {
        $validated = $request->validate([
            'name'        => 'required|string|max:255',
            'designation' => 'required|string|max:255',
            'role_type'   => 'required|in:advisor,executive,staff,volunteer',
            'country'            => 'nullable|string|max:255',
            'email'              => 'nullable|email|max:255',
            'phone'              => 'nullable|string|max:50',
            'research_gate_url'  => 'nullable|url|max:255',
            'google_scholar_url' => 'nullable|url|max:255',
            'order'              => 'integer',
            'photo'       => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:4096',
        ]);

        if ($request->hasFile('photo')) {
            $validated['photo'] = $images->upload(
                $request->file('photo'),
                'uploads/team',
                400, 400, 85
            );
        }

        TeamMember::create($validated);

        return redirect()->route('admin.team-members.index')->with('success', 'Team member added successfully.');
    }

    public function edit(TeamMember $teamMember)
    {
        return view('admin.team-members.edit', compact('teamMember'));
    }

    public function update(Request $request, TeamMember $teamMember, ImageService $images)
    {
        $validated = $request->validate([
            'name'        => 'required|string|max:255',
            'designation' => 'required|string|max:255',
            'role_type'   => 'required|in:advisor,executive,staff,volunteer',
            'country'            => 'nullable|string|max:255',
            'email'              => 'nullable|email|max:255',
            'phone'              => 'nullable|string|max:50',
            'research_gate_url'  => 'nullable|url|max:255',
            'google_scholar_url' => 'nullable|url|max:255',
            'order'              => 'integer',
            'photo'       => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:4096',
        ]);

        if ($request->hasFile('photo')) {
            $validated['photo'] = $images->upload(
                $request->file('photo'),
                'uploads/team',
                400, 400, 85,
                $teamMember->photo
            );
        }

        $teamMember->update($validated);

        return redirect()->route('admin.team-members.index')->with('success', 'Team member updated successfully.');
    }

    public function destroy(TeamMember $teamMember, ImageService $images)
    {
        $images->delete($teamMember->photo);
        $teamMember->delete();
        return redirect()->route('admin.team-members.index')->with('success', 'Team member deleted successfully.');
    }
}
