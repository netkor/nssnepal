<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Services\ImageService;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::orderBy('order')->paginate(15);
        return view('admin.projects.index', compact('projects'));
    }

    public function create()
    {
        return view('admin.projects.create');
    }

    public function store(Request $request, ImageService $images)
    {
        $validated = $request->validate([
            'title'          => 'required|string|max:255',
            'description'    => 'required|string',
            'content'        => 'required|string',
            'status'         => 'required|in:ongoing,completed',
            'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
            'order'          => 'integer',
        ]);

        $validated['slug'] = $this->generateUniqueSlug(Str::slug($validated['title']), Project::class);
        $validated['is_featured'] = $request->has('is_featured');

        if ($request->hasFile('featured_image')) {
            $validated['featured_image'] = $images->upload(
                $request->file('featured_image'),
                'uploads/featured',
                1200, 800, 82
            );
        }

        Project::create($validated);

        return redirect()->route('admin.projects.index')->with('success', 'Project created successfully.');
    }

    public function edit(Project $project)
    {
        return view('admin.projects.edit', compact('project'));
    }

    public function update(Request $request, Project $project, ImageService $images)
    {
        $validated = $request->validate([
            'title'          => 'required|string|max:255',
            'description'    => 'required|string',
            'content'        => 'required|string',
            'status'         => 'required|in:ongoing,completed',
            'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
            'order'          => 'integer',
        ]);

        $validated['is_featured'] = $request->has('is_featured');

        if ($request->hasFile('featured_image')) {
            $validated['featured_image'] = $images->upload(
                $request->file('featured_image'),
                'uploads/featured',
                1200, 800, 82,
                $project->featured_image
            );
        } else {
            unset($validated['featured_image']);
        }

        $project->update($validated);

        return redirect()->route('admin.projects.index')->with('success', 'Project updated successfully.');
    }

    public function destroy(Project $project, ImageService $images)
    {
        $images->delete($project->featured_image);
        $project->delete();
        return redirect()->route('admin.projects.index')->with('success', 'Project deleted successfully.');
    }

    private function generateUniqueSlug(string $slug, string $model, int $ignoreId = 0): string
    {
        $original = $slug;
        $count = 1;
        while ($model::where('slug', $slug)->where('id', '!=', $ignoreId)->exists()) {
            $slug = $original . '-' . $count++;
        }
        return $slug;
    }
}
