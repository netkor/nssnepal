@extends('layouts.admin')

@section('title', 'Manage Partners')
@section('page_title', 'Manage Partners')

@section('content')
    <div class="flex justify-between items-center mb-6">
        <p class="text-text-secondary text-sm">Add or edit key partner organization links.</p>
        <a href="{{ route('admin.partners.create') }}" class="btn-primary py-2 px-4 text-sm flex items-center gap-2">
            <i class="fas fa-plus"></i> Add Partner
        </a>
    </div>

    <div class="admin-card overflow-x-auto">
        <table class="w-full text-left border-collapse text-sm">
            <thead>
                <tr class="border-b border-glass-border/30 text-text-secondary">
                    <th class="py-3 px-4">Logo</th>
                    <th class="py-3 px-4">Name</th>
                    <th class="py-3 px-4">URL</th>
                    <th class="py-3 px-4">Sort Order</th>
                    <th class="py-3 px-4">Status</th>
                    <th class="py-3 px-4 text-right">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($partners as $partner)
                    <tr class="border-b border-glass-border/10 hover:bg-glass-light/5">
                        <td class="py-4 px-4">
                            @if($partner->logo)
                                <img src="{{ $partner->logo }}" alt="{{ $partner->name }} logo" class="h-8 max-w-[80px] object-contain rounded bg-dark-bg/40 p-1 border border-glass-border/15">
                            @else
                                <span class="text-text-muted text-xs"><i class="fas fa-image text-lg"></i></span>
                            @endif
                        </td>
                        <td class="py-4 px-4 font-semibold text-white">{{ $partner->name }}</td>
                        <td class="py-4 px-4 text-text-secondary font-mono">
                            @if($partner->url)
                                <a href="{{ $partner->url }}" target="_blank" class="text-secondary hover:underline">{{ $partner->url }}</a>
                            @else
                                <span class="text-text-muted">(Not Specified)</span>
                            @endif
                        </td>
                        <td class="py-4 px-4 text-text-secondary font-mono">{{ $partner->order }}</td>
                        <td class="py-4 px-4">
                            <span class="badge {{ $partner->is_active ? 'badge-ongoing' : 'badge-completed' }} text-[10px]">
                                {{ $partner->is_active ? 'Active' : 'Inactive' }}
                            </span>
                        </td>
                        <td class="py-4 px-4 text-right">
                            <div class="inline-flex gap-3">
                                <a href="{{ route('admin.partners.edit', $partner->id) }}" class="text-secondary hover:text-white"><i class="fas fa-edit"></i> Edit</a>
                                <form method="POST" action="{{ route('admin.partners.destroy', $partner->id) }}" onsubmit="return confirm('Are you sure you want to delete this partner?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-accent-coral hover:text-white bg-transparent border-none cursor-pointer p-0"><i class="fas fa-trash"></i> Delete</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="py-8 text-center text-text-secondary">No partners added yet.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if($partners->hasPages())
        <div class="mt-6">
            {{ $partners->links() }}
        </div>
    @endif
@endsection
