@extends('layouts.admin')

@section('title', 'Manage News & Events')
@section('page_title', 'Manage News & Events')

@section('content')
    <div class="flex justify-between items-center mb-6">
        <p class="text-text-secondary text-sm">Add or edit news articles and event programs.</p>
        <a href="{{ route('admin.news-events.create') }}" class="btn-primary py-2 px-4 text-sm flex items-center gap-2">
            <i class="fas fa-plus"></i> Add News/Event
        </a>
    </div>

    <div class="admin-card overflow-x-auto">
        <table class="w-full text-left border-collapse text-sm">
            <thead>
                <tr class="border-b border-glass-border/30 text-text-secondary">
                    <th class="py-3 px-4">Title</th>
                    <th class="py-3 px-4">Type</th>
                    <th class="py-3 px-4">Published Date</th>
                    <th class="py-3 px-4">Status</th>
                    <th class="py-3 px-4 text-right">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($news as $item)
                    <tr class="border-b border-glass-border/10 hover:bg-glass-light/5">
                        <td class="py-4 px-4 font-semibold text-text-primary">{{ $item->title }}</td>
                        <td class="py-4 px-4">
                            <span class="badge {{ $item->type === 'event' ? 'badge-ongoing' : 'badge-completed' }} text-[10px]">
                                {{ $item->type }}
                            </span>
                        </td>
                        <td class="py-4 px-4 text-text-secondary font-mono">{{ $item->published_at?->format('M d, Y') ?? 'Not set' }}</td>
                        <td class="py-4 px-4">
                            <span class="badge {{ $item->is_published ? 'badge-ongoing' : 'badge-completed' }} text-[10px]">
                                {{ $item->is_published ? 'Published' : 'Draft' }}
                            </span>
                        </td>
                        <td class="py-4 px-4 text-right">
                            <div class="inline-flex gap-3">
                                <a href="{{ route('admin.news-events.edit', $item->slug) }}" class="text-secondary hover:text-text-primary"><i class="fas fa-edit"></i> Edit</a>
                                <form method="POST" action="{{ route('admin.news-events.destroy', $item->slug) }}" onsubmit="return confirm('Are you sure you want to delete this news/event?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-accent-coral hover:text-text-primary bg-transparent border-none cursor-pointer p-0"><i class="fas fa-trash"></i> Delete</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="py-8 text-center text-text-secondary">No news or events posted yet.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if($news->hasPages())
        <div class="mt-6">
            {{ $news->links() }}
        </div>
    @endif
@endsection
