<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Download;
use Illuminate\Http\Request;

class DownloadController extends Controller
{
    public function index()
    {
        $downloads = Download::orderByDesc('year')->paginate(15);
        return view('admin.downloads.index', compact('downloads'));
    }

    public function create()
    {
        return view('admin.downloads.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'file_path' => 'required|string',
            'type' => 'required|in:publication,report',
            'description' => 'nullable|string',
            'authors' => 'nullable|string|max:255',
            'journal' => 'nullable|string|max:255',
            'year' => 'required|integer',
            'is_active' => 'nullable',
        ]);

        $validated['is_active'] = $request->has('is_active');
        $validated['published_at'] = date($validated['year'].'-01-01 00:00:00');

        Download::create($validated);

        return redirect()->route('admin.downloads.index')->with('success', 'Download resource added successfully.');
    }

    public function edit(Download $download)
    {
        return view('admin.downloads.edit', compact('download'));
    }

    public function update(Request $request, Download $download)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'file_path' => 'required|string',
            'type' => 'required|in:publication,report',
            'description' => 'nullable|string',
            'authors' => 'nullable|string|max:255',
            'journal' => 'nullable|string|max:255',
            'year' => 'required|integer',
            'is_active' => 'nullable',
        ]);

        $validated['is_active'] = $request->has('is_active');
        $validated['published_at'] = date($validated['year'].'-01-01 00:00:00');

        $download->update($validated);

        return redirect()->route('admin.downloads.index')->with('success', 'Download resource updated successfully.');
    }

    public function destroy(Download $download)
    {
        $download->delete();
        return redirect()->route('admin.downloads.index')->with('success', 'Download resource deleted successfully.');
    }
}
