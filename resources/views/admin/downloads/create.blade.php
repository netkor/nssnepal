@extends('layouts.admin')

@section('title', 'Add Resource')
@section('page_title', 'Add Resource')

@section('content')
    <div class="mb-6">
        <a href="{{ route('admin.downloads.index') }}" class="text-secondary hover:text-text-primary text-sm font-semibold flex items-center gap-2"><i class="fas fa-arrow-left"></i> Back to Downloads</a>
    </div>

    <div class="admin-card max-w-2xl">
        <form method="POST" action="{{ route('admin.downloads.store') }}">
            @csrf
            
            <div class="mb-6">
                <label for="title" class="form-label">Resource / Article Title</label>
                <input type="text" id="title" name="title" class="form-input" placeholder="e.g. Common Leopard Survey in Gandaki Province" value="{{ old('title') }}" required>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <div>
                    <label for="type" class="form-label">Resource Type</label>
                    <select id="type" name="type" class="form-input">
                        <option value="publication">Scientific Publication (DOI link)</option>
                        <option value="report">Annual Report (Local file)</option>
                    </select>
                </div>
                <div>
                    <label for="file_path" class="form-label">File Link / URL</label>
                    <input type="text" id="file_path" name="file_path" class="form-input" placeholder="e.g. https://doi.org/10.1002/... or /files/report.pdf" value="{{ old('file_path') }}" required>
                </div>
            </div>

            <div class="mb-6">
                <label for="authors" class="form-label">Authors (For Scientific Publications)</label>
                <input type="text" id="authors" name="authors" class="form-input" placeholder="e.g. Bhandari, S., Adhikari, B., et al." value="{{ old('authors') }}">
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <div>
                    <label for="journal" class="form-label">Journal / Publisher Name</label>
                    <input type="text" id="journal" name="journal" class="form-input" placeholder="e.g. Ecology and Evolution, e8491" value="{{ old('journal') }}">
                </div>
                <div>
                    <label for="year" class="form-label">Publication Year</label>
                    <input type="number" id="year" name="year" class="form-input" value="{{ old('year', date('Y')) }}" required>
                </div>
            </div>

            <div class="mb-6">
                <label for="description" class="form-label">Description (Optional)</label>
                <textarea id="description" name="description" class="form-input h-20 resize-none" placeholder="A brief summary of the publication/report content...">{{ old('description') }}</textarea>
            </div>

            <div class="mb-8">
                <label class="inline-flex items-center text-sm text-text-secondary cursor-pointer">
                    <input type="checkbox" id="is_active" name="is_active" class="rounded border-glass-border bg-dark-surface text-primary-accent focus:ring-primary-accent mr-2" checked>
                    Active / Available for download
                </label>
            </div>

            <button type="submit" class="btn-primary py-3 px-6">
                <i class="fas fa-save mr-2"></i> Save Resource
            </button>
        </form>
    </div>
@endsection
