@extends('layouts.admin')

@section('title', 'Edit Opportunity')
@section('page_title', 'Edit Opportunity')

@section('content')
    <div class="mb-6">
        <a href="{{ route('admin.opportunities.index') }}" class="text-secondary hover:text-white text-sm font-semibold flex items-center gap-2"><i class="fas fa-arrow-left"></i> Back to Opportunities</a>
    </div>

    <div class="admin-card max-w-4xl">
        <form method="POST" action="{{ route('admin.opportunities.update', $opportunity->id) }}">
            @csrf
            @method('PUT')
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <div>
                    <label for="title" class="form-label">Opportunity Title</label>
                    <input type="text" id="title" name="title" class="form-input" value="{{ old('title', $opportunity->title) }}" required>
                </div>
                <div>
                    <label for="type" class="form-label">Type</label>
                    <select id="type" name="type" class="form-input">
                        <option value="thesis_grant" {{ $opportunity->type === 'thesis_grant' ? 'selected' : '' }}>Thesis / Research Grant</option>
                        <option value="volunteer" {{ $opportunity->type === 'volunteer' ? 'selected' : '' }}>Volunteer Program</option>
                        <option value="internship" {{ $opportunity->type === 'internship' ? 'selected' : '' }}>Internship Listing</option>
                    </select>
                </div>
            </div>

            <div class="mb-6">
                <label for="content" class="form-label">Full Content (Rich Text Description)</label>
                <textarea id="content" name="content" class="form-input rich-editor">{{ old('content', $opportunity->content) }}</textarea>
            </div>

            <div class="mb-8">
                <label class="inline-flex items-center text-sm text-text-secondary cursor-pointer">
                    <input type="checkbox" id="is_active" name="is_active" class="rounded border-glass-border bg-dark-surface text-primary-accent focus:ring-primary-accent mr-2" {{ $opportunity->is_active ? 'checked' : '' }}>
                    Active / Open for Application
                </label>
            </div>

            <button type="submit" class="btn-primary py-3 px-6">
                <i class="fas fa-save mr-2"></i> Save Changes
            </button>
        </form>
    </div>
@endsection
