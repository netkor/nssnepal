@extends('layouts.admin')

@section('title', 'Manage Resources & Downloads')
@section('page_title', 'Manage Resources & Downloads')

@section('content')
    <div class="flex justify-between items-center mb-6">
        <p class="text-text-secondary text-sm">Add or edit publication links and office reports.</p>
        <a href="{{ route('admin.downloads.create') }}" class="btn-primary py-2 px-4 text-sm flex items-center gap-2">
            <i class="fas fa-plus"></i> Add New Resource
        </a>
    </div>

    <div class="admin-card overflow-x-auto">
        <table class="w-full text-left border-collapse text-sm">
            <thead>
                <tr class="border-b border-glass-border/30 text-text-secondary">
                    <th class="py-3 px-4">Title</th>
                    <th class="py-3 px-4">Type</th>
                    <th class="py-3 px-4">Year</th>
                    <th class="py-3 px-4">Downloads</th>
                    <th class="py-3 px-4 text-right">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($downloads as $file)
                    <tr class="border-b border-glass-border/10 hover:bg-glass-light/5">
                        <td class="py-4 px-4 font-semibold text-text-primary">
                            {{ $file->title }}
                            @if($file->authors)
                                <span class="block text-xs font-normal text-text-secondary mt-0.5">{{ $file->authors }}</span>
                            @endif
                        </td>
                        <td class="py-4 px-4">
                            <span class="badge {{ $file->type === 'publication' ? 'badge-ongoing' : 'badge-completed' }} text-[10px]">
                                {{ $file->type }}
                            </span>
                        </td>
                        <td class="py-4 px-4 text-text-secondary font-mono">{{ $file->year }}</td>
                        <td class="py-4 px-4 text-text-secondary font-mono">{{ $file->download_count }}</td>
                        <td class="py-4 px-4 text-right">
                            <div class="inline-flex gap-3">
                                <a href="{{ route('admin.downloads.edit', $file->id) }}" class="text-secondary hover:text-text-primary"><i class="fas fa-edit"></i> Edit</a>
                                <form method="POST" action="{{ route('admin.downloads.destroy', $file->id) }}" onsubmit="return confirm('Are you sure you want to delete this resource?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-accent-coral hover:text-text-primary bg-transparent border-none cursor-pointer p-0"><i class="fas fa-trash"></i> Delete</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="py-8 text-center text-text-secondary">No downloadable resources added yet.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if($downloads->hasPages())
        <div class="mt-6">
            {{ $downloads->links() }}
        </div>
    @endif
@endsection
