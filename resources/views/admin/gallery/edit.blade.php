@extends('layouts.admin')

@section('title', 'Edit Album')
@section('page_title', 'Edit Album')

@section('content')
    <div class="mb-6">
        <a href="{{ route('admin.gallery-albums.index') }}" class="text-secondary hover:text-text-primary text-sm font-semibold flex items-center gap-2"><i class="fas fa-arrow-left"></i> Back to Albums</a>
    </div>

    <div class="admin-card max-w-2xl">
        <form method="POST" action="{{ route('admin.gallery-albums.update', $galleryAlbum->slug) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            
            <div class="mb-6">
                <label for="title" class="form-label">Album Title</label>
                <input type="text" id="title" name="title" class="form-input" value="{{ old('title', $galleryAlbum->title) }}" required>
            </div>

            <div class="mb-6">
                <label for="description" class="form-label">Description (Optional)</label>
                <textarea id="description" name="description" class="form-input h-20 resize-none">{{ old('description', $galleryAlbum->description) }}</textarea>
            </div>

            <div class="mb-6">
                <label for="cover_image" class="form-label">Cover Image (Upload new to replace)</label>
                @if($galleryAlbum->cover_image)
                    <div class="mb-2">
                        <p class="text-text-secondary text-xs mb-1">Current cover:</p>
                        <img src="{{ $galleryAlbum->cover_image }}" alt="Current cover" class="max-h-24 object-contain rounded border border-glass-border/20">
                    </div>
                @endif
                <input type="file" id="cover_image" name="cover_image" class="form-input" accept="image/*" onchange="previewImg(this,'preview_cover')">
                <p class="text-text-muted text-xs mt-1">Leave empty to keep current · Auto-resized to 800×600 &amp; saved as WebP</p>
                <img id="preview_cover" src="" alt="" class="mt-2 rounded hidden max-h-28 object-contain border border-glass-border/20">
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                <div>
                    <label for="order" class="form-label">Sort Order</label>
                    <input type="number" id="order" name="order" class="form-input" value="{{ old('order', $galleryAlbum->order) }}" required>
                </div>
                <div class="flex items-end pb-3">
                    <label class="inline-flex items-center text-sm text-text-secondary cursor-pointer">
                        <input type="checkbox" id="is_active" name="is_active" class="rounded border-glass-border bg-dark-surface text-primary-accent focus:ring-primary-accent mr-2" {{ $galleryAlbum->is_active ? 'checked' : '' }}>
                        Active / Visible
                    </label>
                </div>
            </div>

            <button type="submit" class="btn-primary py-3 px-6">
                <i class="fas fa-save mr-2"></i> Save Changes
            </button>
        </form>
    </div>
@endsection
