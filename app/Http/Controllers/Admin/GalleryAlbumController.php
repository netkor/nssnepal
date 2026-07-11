<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\GalleryAlbum;
use App\Models\GalleryImage;
use App\Services\ImageService;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class GalleryAlbumController extends Controller
{
    public function index()
    {
        $albums = GalleryAlbum::withCount('images')->orderBy('order')->paginate(15);
        return view('admin.gallery.index', compact('albums'));
    }

    public function create()
    {
        return view('admin.gallery.create');
    }

    public function store(Request $request, ImageService $images)
    {
        $validated = $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'nullable|string',
            'cover_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
            'order'       => 'integer',
            'is_active'   => 'nullable',
        ]);

        $validated['is_active'] = $request->has('is_active');
        $validated['slug'] = Str::slug($validated['title']);

        if ($request->hasFile('cover_image')) {
            $validated['cover_image'] = $images->upload(
                $request->file('cover_image'),
                'uploads/gallery/covers',
                800, 600, 82
            );
        }

        GalleryAlbum::create($validated);

        return redirect()->route('admin.gallery-albums.index')->with('success', 'Gallery album created successfully.');
    }

    public function edit(GalleryAlbum $galleryAlbum)
    {
        return view('admin.gallery.edit', compact('galleryAlbum'));
    }

    public function update(Request $request, GalleryAlbum $galleryAlbum, ImageService $images)
    {
        $validated = $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'nullable|string',
            'cover_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
            'order'       => 'integer',
            'is_active'   => 'nullable',
        ]);

        $validated['is_active'] = $request->has('is_active');

        if ($request->hasFile('cover_image')) {
            $validated['cover_image'] = $images->upload(
                $request->file('cover_image'),
                'uploads/gallery/covers',
                800, 600, 82,
                $galleryAlbum->cover_image
            );
        } else {
            unset($validated['cover_image']);
        }

        $galleryAlbum->update($validated);

        return redirect()->route('admin.gallery-albums.index')->with('success', 'Gallery album updated successfully.');
    }

    public function destroy(GalleryAlbum $galleryAlbum, ImageService $images)
    {
        // Delete all images inside this album
        foreach ($galleryAlbum->images as $image) {
            $images->delete($image->image_path);
            $image->delete();
        }

        // Delete the album cover
        $images->delete($galleryAlbum->cover_image);
        $galleryAlbum->delete();
        
        return redirect()->route('admin.gallery-albums.index')->with('success', 'Gallery album deleted successfully.');
    }

    // Album details / Manage images
    public function show(GalleryAlbum $galleryAlbum)
    {
        $images = $galleryAlbum->images;
        return view('admin.gallery.show', compact('galleryAlbum', 'images'));
    }

    // Add image to album
    public function addImage(Request $request, GalleryAlbum $galleryAlbum, ImageService $images)
    {
        $request->validate([
            'images'   => 'required|array',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif,webp|max:8192',
        ]);

        $uploadedCount = 0;
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $file) {
                $path = $images->upload(
                    $file,
                    'uploads/gallery/images',
                    1600, 1200, 82
                );

                $galleryAlbum->images()->create([
                    'image_path' => $path,
                    'caption'    => null,
                    'order'      => 0,
                ]);
                $uploadedCount++;
            }
        }

        return back()->with('success', $uploadedCount . ' images added to album successfully.');
    }

    // Delete image from album
    public function deleteImage(GalleryImage $image, ImageService $images)
    {
        $images->delete($image->image_path);
        $image->delete();
        return back()->with('success', 'Image deleted from album successfully.');
    }
}
