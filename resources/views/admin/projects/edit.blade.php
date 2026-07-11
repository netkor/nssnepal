@extends('layouts.admin')

@section('title', 'Edit Project')
@section('page_title', 'Edit Project')

@section('content')
    <div class="mb-6">
        <a href="{{ route('admin.projects.index') }}" class="text-secondary hover:text-white text-sm font-semibold flex items-center gap-2"><i class="fas fa-arrow-left"></i> Back to Projects</a>
    </div>

    <div class="admin-card max-w-4xl">
        <form method="POST" action="{{ route('admin.projects.update', $project->slug) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <div>
                    <label for="title" class="form-label">Project Title</label>
                    <input type="text" id="title" name="title" class="form-input" value="{{ old('title', $project->title) }}" required>
                </div>
                <div>
                    <label for="status" class="form-label">Status</label>
                    <select id="status" name="status" class="form-input">
                        <option value="ongoing" {{ old('status', $project->status) === 'ongoing' ? 'selected' : '' }}>Ongoing</option>
                        <option value="completed" {{ old('status', $project->status) === 'completed' ? 'selected' : '' }}>Completed</option>
                    </select>
                </div>
            </div>

            <div class="mb-6">
                <label for="description" class="form-label">Brief Summary (Excerpt)</label>
                <textarea id="description" name="description" class="form-input h-20 resize-none" required>{{ old('description', $project->description) }}</textarea>
            </div>

            <div class="mb-6">
                <label for="content" class="form-label">Full Content (Rich Text)</label>
                <textarea id="content" name="content" class="form-input rich-editor">{{ old('content', $project->content) }}</textarea>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                <div>
                    <label for="featured_image" class="form-label">Featured Image (Upload new to replace)</label>
                    @if($project->featured_image)
                        <div class="mb-2">
                            <p class="text-text-secondary text-xs mb-1">Current image:</p>
                            <img src="{{ $project->featured_image }}" alt="Current" class="max-h-24 object-contain rounded border border-glass-border/20">
                        </div>
                    @endif
                    <input type="file" id="featured_image" name="featured_image" class="form-input" accept="image/*" onchange="previewImg(this,'preview_fi')">
                    <p class="text-text-muted text-xs mt-1">Leave empty to keep current image · Auto-resized &amp; saved as WebP</p>
                    <img id="preview_fi" src="" alt="" class="mt-2 rounded hidden max-h-32 object-contain border border-glass-border/20">
                </div>
                <div>
                    <label for="order" class="form-label">Sort Order</label>
                    <input type="number" id="order" name="order" class="form-input" value="{{ old('order', $project->order) }}" required>
                </div>
            </div>

            <div class="mb-8">
                <label class="flex items-center gap-3 cursor-pointer">
                    <input type="checkbox" name="is_featured" value="1" {{ old('is_featured', $project->is_featured) ? 'checked' : '' }} class="w-5 h-5 text-primary-accent rounded border-glass-border/30 bg-glass-light/10 focus:ring-primary-accent focus:ring-offset-dark-bg">
                    <span class="text-white font-medium">Feature on Homepage</span>
                </label>
                <p class="text-text-muted text-xs mt-1 ml-8">If checked, this project will appear in the top 3 featured slots on the homepage.</p>
            </div>

            <button type="submit" class="btn-primary py-3 px-6">
                <i class="fas fa-save mr-2"></i> Save Changes
            </button>
        </form>
    </div>
@endsection
