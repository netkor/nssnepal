@extends('layouts.admin')

@section('title', 'Add Hero Slide')
@section('page_title', 'Add Hero Slide')

@section('content')
    <div class="mb-6">
        <a href="{{ route('admin.sliders.index') }}" class="text-secondary hover:text-text-primary text-sm font-semibold flex items-center gap-2"><i class="fas fa-arrow-left"></i> Back to Sliders</a>
    </div>

    <div class="admin-card max-w-2xl">
        <form method="POST" action="{{ route('admin.sliders.store') }}" enctype="multipart/form-data">
            @csrf
            
            <div class="mb-6">
                <label for="title" class="form-label">Slide Title</label>
                <input type="text" id="title" name="title" class="form-input" placeholder="e.g. Protecting Wildlife" value="{{ old('title') }}" required>
            </div>

            <div class="mb-6">
                <label for="subtitle" class="form-label">Subtitle / Description</label>
                <textarea id="subtitle" name="subtitle" class="form-input h-20 resize-none" placeholder="A short description overlayed on the image..." required>{{ old('subtitle') }}</textarea>
            </div>

            <div class="mb-6">
                <label for="image" class="form-label">Hero Slide Image <span class="text-accent-coral">*</span></label>
                <input type="file" id="image" name="image" class="form-input" accept="image/*" required onchange="previewImg(this,'preview_slider')">
                <p class="text-text-muted text-xs mt-1">Recommended: 1920×1080 landscape · Auto-resized &amp; saved as WebP</p>
                <img id="preview_slider" src="" alt="" class="mt-2 rounded hidden max-h-40 object-contain border border-glass-border/20">
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <div>
                    <label for="button_text" class="form-label">Button Text (Optional)</label>
                    <input type="text" id="button_text" name="button_text" class="form-input" placeholder="e.g. Learn More" value="{{ old('button_text') }}">
                </div>
                <div>
                    <label for="button_url" class="form-label">Button Target URL (Optional)</label>
                    <input type="text" id="button_url" name="button_url" class="form-input" placeholder="e.g. /projects" value="{{ old('button_url') }}">
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                <div>
                    <label for="order" class="form-label">Sort Order</label>
                    <input type="number" id="order" name="order" class="form-input" value="{{ old('order', 0) }}" required>
                </div>
                <div class="flex items-end pb-3">
                    <label class="inline-flex items-center text-sm text-text-secondary cursor-pointer">
                        <input type="checkbox" id="is_active" name="is_active" class="rounded border-glass-border bg-dark-surface text-primary-accent focus:ring-primary-accent mr-2" checked>
                        Active / Visible
                    </label>
                </div>
            </div>

            <button type="submit" class="btn-primary py-3 px-6">
                <i class="fas fa-save mr-2"></i> Save Slide
            </button>
        </form>
    </div>
@endsection
