@extends('layouts.admin')

@section('title', 'Manage Opportunities')
@section('page_title', 'Manage Opportunities')

@section('content')
    <div class="flex justify-between items-center mb-6">
        <p class="text-text-secondary text-sm">Create thesis grant announcements or volunteer programs.</p>
        <a href="{{ route('admin.opportunities.create') }}" class="btn-primary py-2 px-4 text-sm flex items-center gap-2">
            <i class="fas fa-plus"></i> Add Opportunity
        </a>
    </div>

    <div class="admin-card overflow-x-auto">
        <table class="w-full text-left border-collapse text-sm">
            <thead>
                <tr class="border-b border-glass-border/30 text-text-secondary">
                    <th class="py-3 px-4">Title</th>
                    <th class="py-3 px-4">Type</th>
                    <th class="py-3 px-4">Status</th>
                    <th class="py-3 px-4 text-right">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($opportunities as $opp)
                    <tr class="border-b border-glass-border/10 hover:bg-glass-light/5">
                        <td class="py-4 px-4 font-semibold text-text-primary">{{ $opp->title }}</td>
                        <td class="py-4 px-4">
                            <span class="badge badge-ongoing text-[10px]">
                                {{ str_replace('_', ' ', $opp->type) }}
                            </span>
                        </td>
                        <td class="py-4 px-4">
                            <span class="badge {{ $opp->is_active ? 'badge-ongoing' : 'badge-completed' }} text-[10px]">
                                {{ $opp->is_active ? 'Active' : 'Inactive' }}
                            </span>
                        </td>
                        <td class="py-4 px-4 text-right">
                            <div class="inline-flex gap-3">
                                <a href="{{ route('admin.opportunities.edit', $opp->id) }}" class="text-secondary hover:text-text-primary"><i class="fas fa-edit"></i> Edit</a>
                                <form method="POST" action="{{ route('admin.opportunities.destroy', $opp->id) }}" onsubmit="return confirm('Are you sure you want to delete this listing?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-accent-coral hover:text-text-primary bg-transparent border-none cursor-pointer p-0"><i class="fas fa-trash"></i> Delete</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="py-8 text-center text-text-secondary">No opportunity listings found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if($opportunities->hasPages())
        <div class="mt-6">
            {{ $opportunities->links() }}
        </div>
    @endif
@endsection
