@extends('layouts.admin')

@section('title', 'Inbox Messages')
@section('page_title', 'Inbox Messages')

@section('content')
    <p class="text-text-secondary text-sm mb-6">Read and respond to inquiries from website visitors.</p>

    <div class="admin-card overflow-x-auto">
        <table class="w-full text-left border-collapse text-sm">
            <thead>
                <tr class="border-b border-glass-border/30 text-text-secondary">
                    <th class="py-3 px-4">Sender</th>
                    <th class="py-3 px-4">Email</th>
                    <th class="py-3 px-4">Subject</th>
                    <th class="py-3 px-4">Date</th>
                    <th class="py-3 px-4 text-right">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($messages as $msg)
                    <tr class="border-b border-glass-border/10 hover:bg-glass-light/5 {{ !$msg->is_read ? 'bg-glass-light/10 font-bold' : '' }}">
                        <td class="py-4 px-4 text-text-primary">
                            @if(!$msg->is_read)
                                <span class="w-2.5 h-2.5 rounded-full bg-accent-coral inline-block mr-2"></span>
                            @endif
                            {{ $msg->name }}
                        </td>
                        <td class="py-4 px-4 text-text-secondary">{{ $msg->email }}</td>
                        <td class="py-4 px-4 text-text-secondary">{{ $msg->subject ?? '(No Subject)' }}</td>
                        <td class="py-4 px-4 text-text-muted">{{ $msg->created_at->format('M d, Y H:i') }}</td>
                        <td class="py-4 px-4 text-right">
                            <div class="inline-flex gap-3">
                                <a href="{{ route('admin.messages.show', $msg->id) }}" class="text-secondary hover:text-text-primary"><i class="fas fa-envelope-open"></i> Read</a>
                                <form method="POST" action="{{ route('admin.messages.destroy', $msg->id) }}" onsubmit="return confirm('Are you sure you want to delete this message?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-accent-coral hover:text-text-primary bg-transparent border-none cursor-pointer p-0"><i class="fas fa-trash"></i> Delete</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="py-8 text-center text-text-secondary">No messages received yet.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if($messages->hasPages())
        <div class="mt-6">
            {{ $messages->links() }}
        </div>
    @endif
@endsection
