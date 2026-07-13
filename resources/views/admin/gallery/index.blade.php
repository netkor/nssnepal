@extends('layouts.admin')

@section('title', 'Manage Gallery Albums')
@section('page_title', 'Manage Gallery Albums')

@section('content')
    <div class="flex justify-between items-center mb-6">
        <p class="text-text-secondary text-sm">Add or edit photo albums, and manage their images.</p>
        <a href="{{ route('admin.gallery-albums.create') }}" class="btn-primary py-2 px-4 text-sm flex items-center gap-2">
            <i class="fas fa-plus"></i> Add Gallery Album
        </a>
    </div>

    <div class="admin-card overflow-x-auto">
        <table class="w-full text-left border-collapse text-sm">
            <thead>
                <tr class="border-b border-glass-border/30 text-text-secondary">
                    <th class="py-3 px-4">Cover</th>
                    <th class="py-3 px-4">Title</th>
                    <th class="py-3 px-4">Images Count</th>
                    <th class="py-3 px-4">Status</th>
                    <th class="py-3 px-4 text-right">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($albums as $album)
                    <tr class="border-b border-glass-border/10 hover:bg-glass-light/5">
                        <td class="py-3 px-4">
                            <div class="w-12 h-12 rounded overflow-hidden bg-primary-light/10 border border-glass-border/20">
                                @if($album->display_cover)
                                    <img src="{{ $album->display_cover }}" alt="Cover" class="w-full h-full object-cover">
                                @else
                                    <div class="w-full h-full flex items-center justify-center text-text-muted"><i class="fas fa-image"></i></div>
                                @endif
                            </div>
                        </td>
                        <td class="py-3 px-4 font-semibold text-text-primary">
                            <a href="{{ route('admin.gallery-albums.show', $album->slug) }}" class="text-secondary hover:underline">{{ $album->title }}</a>
                        </td>
                        <td class="py-3 px-4 text-text-secondary font-mono">{{ $album->images->count() }}</td>
                        <td class="py-3 px-4">
                            <span class="badge {{ $album->is_active ? 'badge-ongoing' : 'badge-completed' }} text-[10px]">
                                {{ $album->is_active ? 'Active' : 'Inactive' }}
                            </span>
                        </td>
                        <td class="py-3 px-4 text-right">
                            <div class="inline-flex gap-3">
                                <a href="{{ route('admin.gallery-albums.show', $album->slug) }}" class="text-secondary hover:text-text-primary"><i class="fas fa-images"></i> Manage Photos</a>
                                <a href="{{ route('admin.gallery-albums.edit', $album->slug) }}" class="text-secondary hover:text-text-primary"><i class="fas fa-edit"></i> Edit</a>
                                <form method="POST" action="{{ route('admin.gallery-albums.destroy', $album->slug) }}" onsubmit="return confirm('Are you sure you want to delete this album?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-accent-coral hover:text-text-primary bg-transparent border-none cursor-pointer p-0"><i class="fas fa-trash"></i> Delete</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="py-8 text-center text-text-secondary">No gallery albums added yet.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if($albums->hasPages())
        <div class="mt-6">
            {{ $albums->links() }}
        </div>
    @endif
@endsection
