<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\GalleryAlbum;
use App\Models\GalleryImage;

class GalleryAlbumTest extends TestCase
{
    use RefreshDatabase;

    public function test_display_cover_attribute_returns_manual_cover_if_provided(): void
    {
        $album = GalleryAlbum::create([
            'title' => 'Test Album',
            'slug' => 'test-album',
            'cover_image' => 'manual_cover.jpg',
            'is_active' => true,
        ]);

        $this->assertEquals('manual_cover.jpg', $album->display_cover);
    }

    public function test_display_cover_attribute_falls_back_to_first_image_if_cover_is_missing(): void
    {
        $album = GalleryAlbum::create([
            'title' => 'Test Album',
            'slug' => 'test-album',
            'cover_image' => null, // Explicitly null
            'is_active' => true,
        ]);

        // Add an image to the album
        GalleryImage::create([
            'gallery_album_id' => $album->id,
            'image_path' => 'first_photo.jpg',
        ]);
        
        // Add a second image
        GalleryImage::create([
            'gallery_album_id' => $album->id,
            'image_path' => 'second_photo.jpg',
        ]);

        // Assert it pulls the first one
        $this->assertEquals('first_photo.jpg', $album->display_cover);
    }

    public function test_display_cover_returns_null_if_empty_and_no_images_exist(): void
    {
        $album = GalleryAlbum::create([
            'title' => 'Test Album',
            'slug' => 'test-album',
            'cover_image' => null,
            'is_active' => true,
        ]);

        $this->assertNull($album->display_cover);
    }
}
