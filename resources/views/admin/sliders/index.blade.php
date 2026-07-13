@extends('layouts.admin')

@section('title', 'Manage Hero Sliders')
@section('page_title', 'Manage Hero Sliders')

@section('content')
    <div class="flex justify-between items-center mb-6">
        <p class="text-text-secondary text-sm">Add or edit homepage hero carousel banners.</p>
        <a href="{{ route('admin.sliders.create') }}" class="btn-primary py-2 px-4 text-sm flex items-center gap-2">
            <i class="fas fa-plus"></i> Add New Slide
        </a>
    </div>

    <div class="admin-card overflow-x-auto">
        <table class="w-full text-left border-collapse text-sm">
            <thead>
                <tr class="border-b border-glass-border/30 text-text-secondary">
                    <th class="py-3 px-4">Image Preview</th>
                    <th class="py-3 px-4">Title</th>
                    <th class="py-3 px-4">Order</th>
                    <th class="py-3 px-4">Status</th>
                    <th class="py-3 px-4 text-right">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($sliders as $slide)
                    <tr class="border-b border-glass-border/10 hover:bg-glass-light/5">
                        <td class="py-3 px-4">
                            <div class="w-20 h-10 rounded overflow-hidden bg-primary-light/10 border border-glass-border/20">
                                <img src="{{ $slide->image }}" alt="Preview" class="w-full h-full object-cover">
                            </div>
                        </td>
                        <td class="py-3 px-4 font-semibold text-text-primary">
                            {{ $slide->title }}
                            <span class="block text-xs font-normal text-text-secondary mt-0.5 truncate max-w-sm">{{ $slide->subtitle }}</span>
                        </td>
                        <td class="py-3 px-4 text-text-secondary font-mono">{{ $slide->order }}</td>
                        <td class="py-3 px-4">
                            <span class="badge {{ $slide->is_active ? 'badge-ongoing' : 'badge-completed' }} text-[10px]">
                                {{ $slide->is_active ? 'Active' : 'Inactive' }}
                            </span>
                        </td>
                        <td class="py-3 px-4 text-right">
                            <div class="inline-flex gap-3">
                                <a href="{{ route('admin.sliders.edit', $slide->id) }}" class="text-secondary hover:text-text-primary"><i class="fas fa-edit"></i> Edit</a>
                                <form method="POST" action="{{ route('admin.sliders.destroy', $slide->id) }}" onsubmit="return confirm('Are you sure you want to delete this slide?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-accent-coral hover:text-text-primary bg-transparent border-none cursor-pointer p-0"><i class="fas fa-trash"></i> Delete</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="py-8 text-center text-text-secondary">No hero banners created yet.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if($sliders->hasPages())
        <div class="mt-6">
            {{ $sliders->links() }}
        </div>
    @endif
@endsection
