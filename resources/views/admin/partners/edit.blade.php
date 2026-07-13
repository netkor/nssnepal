@extends('layouts.admin')

@section('title', 'Edit Partner')
@section('page_title', 'Edit Partner')

@section('content')
    <div class="mb-6">
        <a href="{{ route('admin.partners.index') }}" class="text-secondary hover:text-text-primary text-sm font-semibold flex items-center gap-2"><i class="fas fa-arrow-left"></i> Back to Partners</a>
    </div>

    <div class="admin-card max-w-2xl">
        <form method="POST" action="{{ route('admin.partners.update', $partner->id) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            
            <div class="mb-6">
                <label for="name" class="form-label">Partner Organization Name</label>
                <input type="text" id="name" name="name" class="form-input" value="{{ old('name', $partner->name) }}" required>
            </div>

            <div class="mb-6">
                <label for="logo" class="form-label">Partner Logo File (Upload new to replace)</label>
                @if($partner->logo)
                    <div class="mb-3">
                        <p class="text-text-secondary text-xs mb-1">Current Logo:</p>
                        <img src="{{ $partner->logo }}" alt="Current logo" class="h-10 max-w-[120px] object-contain rounded bg-dark-bg/40 p-1 border border-glass-border/15">
                    </div>
                @endif
                <input type="file" id="logo" name="logo" class="form-input" accept="image/*">
                <p class="text-text-muted text-xs mt-1">Recommended: Transparent PNG or SVG logo.</p>
            </div>

            <div class="mb-6">
                <label for="url" class="form-label">Website URL</label>
                <input type="url" id="url" name="url" class="form-input" value="{{ old('url', $partner->url) }}">
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                <div>
                    <label for="order" class="form-label">Sort Order</label>
                    <input type="number" id="order" name="order" class="form-input" value="{{ old('order', $partner->order) }}" required>
                </div>
                <div class="flex items-end pb-3">
                    <label class="inline-flex items-center text-sm text-text-secondary cursor-pointer">
                        <input type="checkbox" id="is_active" name="is_active" class="rounded border-glass-border bg-dark-surface text-primary-accent focus:ring-primary-accent mr-2" {{ $partner->is_active ? 'checked' : '' }}>
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
