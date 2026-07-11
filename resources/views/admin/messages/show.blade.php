@extends('layouts.admin')

@section('title', 'Read Message')
@section('page_title', 'Read Message')

@section('content')
    <div class="mb-6">
        <a href="{{ route('admin.messages.index') }}" class="text-secondary hover:text-white text-sm font-semibold flex items-center gap-2"><i class="fas fa-arrow-left"></i> Back to Inbox</a>
    </div>

    <div class="admin-card max-w-3xl">
        <div class="flex flex-col gap-6">
            <div class="flex justify-between items-start border-b border-glass-border/30 pb-4">
                <div>
                    <h3 class="text-xl font-bold text-white mb-1">{{ $message->name }}</h3>
                    <p class="text-text-secondary text-sm">From: <a href="mailto:{{ $message->email }}" class="text-secondary hover:underline">{{ $message->email }}</a></p>
                </div>
                <span class="text-text-muted text-xs"><i class="fas fa-calendar-alt mr-1"></i> {{ $message->created_at->format('F d, Y H:i') }}</span>
            </div>

            <div>
                <h4 class="text-text-muted text-xs font-semibold uppercase tracking-wider mb-2">Subject</h4>
                <p class="text-white text-md font-semibold">{{ $message->subject ?? '(No Subject Specified)' }}</p>
            </div>

            <div>
                <h4 class="text-text-muted text-xs font-semibold uppercase tracking-wider mb-2">Message Body</h4>
                <div class="glass p-6 rounded-lg border border-glass-border/20 text-text-secondary leading-relaxed whitespace-pre-wrap">
                    {{ $message->message }}
                </div>
            </div>

            <div class="border-t border-glass-border/30 pt-6 flex justify-between items-center">
                <a href="mailto:{{ $message->email }}?subject=RE: {{ rawurlencode($message->subject ?? 'Inquiry') }}" class="btn-primary py-2.5 px-6 flex items-center gap-2">
                    <i class="fas fa-reply text-secondary"></i> Reply via Email
                </a>
                <form method="POST" action="{{ route('admin.messages.destroy', $message->id) }}" onsubmit="return confirm('Are you sure you want to delete this message?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn-secondary py-2.5 px-6 border-accent-coral/30 text-accent-coral hover:bg-accent-coral hover:text-white flex items-center gap-2">
                        <i class="fas fa-trash text-xs"></i> Delete Message
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection
