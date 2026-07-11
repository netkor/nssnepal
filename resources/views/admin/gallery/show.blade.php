@extends('layouts.admin')

@section('title', 'Manage Photos — ' . $galleryAlbum->title)
@section('page_title', 'Manage Photos — ' . $galleryAlbum->title)

@section('content')
    <div class="mb-6">
        <a href="{{ route('admin.gallery-albums.index') }}" class="text-secondary hover:text-white text-sm font-semibold flex items-center gap-2"><i class="fas fa-arrow-left"></i> Back to Albums</a>
    </div>

    <!-- Main Grid split -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        
        <!-- Album Images Grid -->
        <div class="lg:col-span-2 admin-card">
            <h3 class="text-white font-heading font-bold text-lg mb-6 border-b border-glass-border/30 pb-3">Album Photos</h3>
            
            <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                @forelse($images as $image)
                    <div class="relative overflow-hidden rounded-lg aspect-square border border-glass-border/20 group">
                        <img src="{{ $image->image_path }}" alt="Preview" class="w-full h-full object-cover">
                        <div class="absolute inset-0 bg-black/60 opacity-0 group-hover:opacity-100 transition duration-300 flex items-center justify-center">
                            <form method="POST" action="{{ route('admin.gallery-albums.images.destroy', $image->id) }}" onsubmit="return confirm('Are you sure you want to delete this image?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-accent-coral hover:bg-accent-coral/80 text-white rounded p-2 text-sm transition border-0 cursor-pointer flex items-center justify-center shadow-lg">
                                    <i class="fas fa-trash-alt mr-1.5"></i> Delete
                                </button>
                            </form>
                        </div>
                    </div>
                @empty
                    <div class="col-span-3 text-center py-12 text-text-secondary">
                        <i class="fas fa-images text-3xl mb-2 text-primary-muted"></i>
                        <p class="text-sm">No photos added to this album yet.</p>
                    </div>
                @endforelse
            </div>
        </div>

        <!-- Add Photos Form (Bulk Upload) -->
        <div class="admin-card h-fit">
            <h3 class="text-white font-heading font-bold text-lg mb-6 border-b border-glass-border/30 pb-3">Upload Photos</h3>
            
            <form method="POST" action="{{ route('admin.gallery-albums.images.store', $galleryAlbum->slug) }}" enctype="multipart/form-data">
                @csrf
                <div class="mb-6">
                    <label for="images" class="form-label">Select Photos (Bulk upload supported)</label>
                    <input type="file" id="images" name="images[]" class="form-input" accept="image/*" required multiple onchange="previewMultipleImgs(this, 'preview_photos_container')">
                    <p class="text-text-muted text-xs mt-1">Select one or multiple images · Auto-resized &amp; compressed to WebP</p>
                    
                    <!-- Previews grid -->
                    <div id="preview_photos_container" class="mt-4 grid grid-cols-4 gap-2 hidden"></div>
                </div>

                <button type="submit" class="btn-primary w-full text-center justify-center py-2.5 rounded-lg flex items-center gap-2">
                    <i class="fas fa-upload"></i> Upload to Album
                </button>
            </form>
        </div>

    </div>
@endsection
