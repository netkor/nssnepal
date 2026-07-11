<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\NewsEvent;
use App\Services\ImageService;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class NewsEventController extends Controller
{
    public function index()
    {
        $news = NewsEvent::orderByDesc('created_at')->paginate(15);
        return view('admin.news-events.index', compact('news'));
    }

    public function create()
    {
        return view('admin.news-events.create');
    }

    public function store(Request $request, ImageService $images)
    {
        $validated = $request->validate([
            'title'          => 'required|string|max:255',
            'excerpt'        => 'required|string',
            'content'        => 'required|string',
            'type'           => 'required|in:news,event',
            'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
            'published_at'   => 'required|date',
            'is_published'   => 'nullable',
        ]);

        $validated['is_published'] = $request->has('is_published');
        $validated['slug'] = $this->generateUniqueSlug(Str::slug($validated['title']), NewsEvent::class);

        if ($request->hasFile('featured_image')) {
            $validated['featured_image'] = $images->upload(
                $request->file('featured_image'),
                'uploads/featured',
                1200, 800, 82
            );
        }

        NewsEvent::create($validated);

        return redirect()->route('admin.news-events.index')->with('success', 'News or Event created successfully.');
    }

    public function edit(NewsEvent $newsEvent)
    {
        return view('admin.news-events.edit', compact('newsEvent'));
    }

    public function update(Request $request, NewsEvent $newsEvent, ImageService $images)
    {
        $validated = $request->validate([
            'title'          => 'required|string|max:255',
            'excerpt'        => 'required|string',
            'content'        => 'required|string',
            'type'           => 'required|in:news,event',
            'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
            'published_at'   => 'required|date',
            'is_published'   => 'nullable',
        ]);

        $validated['is_published'] = $request->has('is_published');

        if ($request->hasFile('featured_image')) {
            $validated['featured_image'] = $images->upload(
                $request->file('featured_image'),
                'uploads/featured',
                1200, 800, 82,
                $newsEvent->featured_image
            );
        } else {
            unset($validated['featured_image']);
        }

        $newsEvent->update($validated);

        return redirect()->route('admin.news-events.index')->with('success', 'News or Event updated successfully.');
    }

    public function destroy(NewsEvent $newsEvent, ImageService $images)
    {
        $images->delete($newsEvent->featured_image);
        $newsEvent->delete();
        return redirect()->route('admin.news-events.index')->with('success', 'News or Event deleted successfully.');
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
