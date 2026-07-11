<?php

namespace App\Http\Controllers;

use App\Models\GalleryAlbum;
use Illuminate\Http\Request;

class GalleryController extends Controller
{
    public function index()
    {
        $albums = GalleryAlbum::with('images')->active()->paginate(9);
        return view('pages.gallery', compact('albums'));
    }

    public function album(GalleryAlbum $album)
    {
        if (!$album->is_active) {
            abort(404);
        }
        
        $images = $album->images;
        return view('pages.gallery-album', compact('album', 'images'));
    }
}
