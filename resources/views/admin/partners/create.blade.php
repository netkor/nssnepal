@extends('layouts.admin')

@section('title', 'Add Partner')
@section('page_title', 'Add Partner')

@section('content')
    <div class="mb-6">
        <a href="{{ route('admin.partners.index') }}" class="text-secondary hover:text-text-primary text-sm font-semibold flex items-center gap-2"><i class="fas fa-arrow-left"></i> Back to Partners</a>
    </div>

    <div class="admin-card max-w-2xl">
        <form method="POST" action="{{ route('admin.partners.store') }}" enctype="multipart/form-data">
            @csrf
            
            <div class="mb-6">
                <label for="name" class="form-label">Partner Organization Name</label>
                <input type="text" id="name" name="name" class="form-input" placeholder="e.g. Idea Wild" value="{{ old('name') }}" required>
            </div>

            <div class="mb-6">
                <label for="logo" class="form-label">Partner Logo File</label>
                <input type="file" id="logo" name="logo" class="form-input" accept="image/*">
                <p class="text-text-muted text-xs mt-1">Recommended: Transparent PNG or SVG logo.</p>
            </div>

            <div class="mb-6">
                <label for="url" class="form-label">Website URL (Optional)</label>
                <input type="url" id="url" name="url" class="form-input" placeholder="e.g. http://www.ideawild.org" value="{{ old('url') }}">
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
                <i class="fas fa-save mr-2"></i> Save Partner
            </button>
        </form>
    </div>
@endsection
