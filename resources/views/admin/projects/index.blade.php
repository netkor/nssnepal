@extends('layouts.admin')

@section('title', 'Manage Projects')
@section('page_title', 'Manage Projects')

@section('content')
    <div class="flex justify-between items-center mb-6">
        <p class="text-text-secondary text-sm">Add, edit, or delete conservation projects.</p>
        <a href="{{ route('admin.projects.create') }}" class="btn-primary py-2 px-4 text-sm flex items-center gap-2">
            <i class="fas fa-plus"></i> Add New Project
        </a>
    </div>

    <div class="admin-card overflow-x-auto">
        <table class="w-full text-left border-collapse text-sm">
            <thead>
                <tr class="border-b border-glass-border/30 text-text-secondary">
                    <th class="py-3 px-4">Title</th>
                    <th class="py-3 px-4">Status</th>
                    <th class="py-3 px-4">Sort Order</th>
                    <th class="py-3 px-4 text-right">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($projects as $project)
                    <tr class="border-b border-glass-border/10 hover:bg-glass-light/5">
                        <td class="py-4 px-4 font-semibold text-text-primary">
                            {{ $project->title }}
                            @if($project->is_featured)
                                <i class="fas fa-star text-accent-gold ml-2 text-xs" title="Featured on Homepage"></i>
                            @endif
                        </td>
                        <td class="py-4 px-4">
                            <span class="badge {{ $project->status === 'ongoing' ? 'badge-ongoing' : 'badge-completed' }} text-[10px]">
                                {{ $project->status }}
                            </span>
                        </td>
                        <td class="py-4 px-4 text-text-secondary font-mono">{{ $project->order }}</td>
                        <td class="py-4 px-4 text-right">
                            <div class="inline-flex gap-3">
                                <a href="{{ route('admin.projects.edit', $project->slug) }}" class="text-secondary hover:text-text-primary"><i class="fas fa-edit"></i> Edit</a>
                                <form method="POST" action="{{ route('admin.projects.destroy', $project->slug) }}" onsubmit="return confirm('Are you sure you want to delete this project?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-accent-coral hover:text-text-primary bg-transparent border-none cursor-pointer p-0"><i class="fas fa-trash"></i> Delete</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="py-8 text-center text-text-secondary">No projects added yet. Click 'Add New Project' above to create one.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if($projects->hasPages())
        <div class="mt-6">
            {{ $projects->links() }}
        </div>
    @endif
@endsection
