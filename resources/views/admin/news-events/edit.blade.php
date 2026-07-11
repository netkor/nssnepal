@extends('layouts.admin')

@section('title', 'Edit News or Event')
@section('page_title', 'Edit News or Event')

@section('content')
    <div class="mb-6">
        <a href="{{ route('admin.news-events.index') }}" class="text-secondary hover:text-white text-sm font-semibold flex items-center gap-2"><i class="fas fa-arrow-left"></i> Back to News & Events</a>
    </div>

    <div class="admin-card max-w-4xl">
        <form method="POST" action="{{ route('admin.news-events.update', $newsEvent->slug) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <div>
                    <label for="title" class="form-label">Title</label>
                    <input type="text" id="title" name="title" class="form-input" value="{{ old('title', $newsEvent->title) }}" required>
                </div>
                <div>
                    <label for="type" class="form-label">Type</label>
                    <select id="type" name="type" class="form-input">
                        <option value="news" {{ old('type', $newsEvent->type) === 'news' ? 'selected' : '' }}>News Announcement</option>
                        <option value="event" {{ old('type', $newsEvent->type) === 'event' ? 'selected' : '' }}>Event Program</option>
                    </select>
                </div>
            </div>

            <div class="mb-6">
                <label for="excerpt" class="form-label">Brief Summary (Excerpt)</label>
                <textarea id="excerpt" name="excerpt" class="form-input h-20 resize-none" required>{{ old('excerpt', $newsEvent->excerpt) }}</textarea>
            </div>

            <div class="mb-6">
                <label for="content" class="form-label">Full Content (Rich Text)</label>
                <textarea id="content" name="content" class="form-input rich-editor">{{ old('content', $newsEvent->content) }}</textarea>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                <div>
                    <label for="featured_image" class="form-label">Featured Image (Upload new to replace)</label>
                    @if($newsEvent->featured_image)
                        <div class="mb-2">
                            <p class="text-text-secondary text-xs mb-1">Current:</p>
                            <img src="{{ $newsEvent->featured_image }}" alt="Current" class="max-h-20 object-contain rounded border border-glass-border/20">
                        </div>
                    @endif
                    <input type="file" id="featured_image" name="featured_image" class="form-input" accept="image/*" onchange="previewImg(this,'preview_fi')">
                    <p class="text-text-muted text-xs mt-1">Leave empty to keep current · Saved as WebP</p>
                    <img id="preview_fi" src="" alt="" class="mt-2 rounded hidden max-h-28 object-contain border border-glass-border/20">
                </div>
                <div>
                    <label for="published_at" class="form-label">Publication Date</label>
                    <input type="date" id="published_at" name="published_at" class="form-input" value="{{ old('published_at', $newsEvent->published_at?->format('Y-m-d') ?? date('Y-m-d')) }}" required>
                </div>
                <div class="flex items-end pb-3">
                    <label class="inline-flex items-center text-sm text-text-secondary cursor-pointer">
                        <input type="checkbox" id="is_published" name="is_published" class="rounded border-glass-border bg-dark-surface text-primary-accent focus:ring-primary-accent mr-2" {{ $newsEvent->is_published ? 'checked' : '' }}>
                        Publish / Visible immediately
                    </label>
                </div>
            </div>

            <button type="submit" class="btn-primary py-3 px-6">
                <i class="fas fa-save mr-2"></i> Save Changes
            </button>
        </form>
    </div>
@endsection
