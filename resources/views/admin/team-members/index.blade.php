@extends('layouts.admin')

@section('title', 'Manage Team Members')
@section('page_title', 'Manage Team Members')

@section('content')
    <div class="flex justify-between items-center mb-6">
        <p class="text-text-secondary text-sm">Add or edit advisors, executives, staff, and volunteers.</p>
        <a href="{{ route('admin.team-members.create') }}" class="btn-primary py-2 px-4 text-sm flex items-center gap-2">
            <i class="fas fa-plus"></i> Add New Member
        </a>
    </div>

    <div class="admin-card overflow-x-auto">
        <table class="w-full text-left border-collapse text-sm">
            <thead>
                <tr class="border-b border-glass-border/30 text-text-secondary">
                    <th class="py-3 px-4">Name</th>
                    <th class="py-3 px-4">Designation</th>
                    <th class="py-3 px-4">Role Type</th>
                    <th class="py-3 px-4">Sort Order</th>
                    <th class="py-3 px-4 text-right">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($team as $member)
                    <tr class="border-b border-glass-border/10 hover:bg-glass-light/5">
                        <td class="py-4 px-4 font-semibold text-text-primary">{{ $member->name }}</td>
                        <td class="py-4 px-4 text-text-secondary">{{ $member->designation }}</td>
                        <td class="py-4 px-4">
                            <span class="badge badge-ongoing text-[10px]">
                                {{ $member->role_type }}
                            </span>
                        </td>
                        <td class="py-4 px-4 text-text-secondary font-mono">{{ $member->order }}</td>
                        <td class="py-4 px-4 text-right">
                            <div class="inline-flex gap-3">
                                <a href="{{ route('admin.team-members.edit', $member->id) }}" class="text-secondary hover:text-text-primary"><i class="fas fa-edit"></i> Edit</a>
                                <form method="POST" action="{{ route('admin.team-members.destroy', $member->id) }}" onsubmit="return confirm('Are you sure you want to delete this member?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-accent-coral hover:text-text-primary bg-transparent border-none cursor-pointer p-0"><i class="fas fa-trash"></i> Delete</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="py-8 text-center text-text-secondary">No team members added yet.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if($team->hasPages())
        <div class="mt-6">
            {{ $team->links() }}
        </div>
    @endif
@endsection
