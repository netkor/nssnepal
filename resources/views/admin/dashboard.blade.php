@extends('layouts.admin')

@section('title', 'Dashboard')
@section('page_title', 'Dashboard Overview')

@section('content')
    <!-- Statistics Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <!-- Card 1 -->
        <div class="admin-card flex items-center justify-between">
            <div>
                <span class="text-text-muted text-xs font-semibold uppercase tracking-wider block mb-1">Total Projects</span>
                <span class="text-3xl font-heading font-extrabold text-text-primary">{{ $projectsCount }}</span>
            </div>
            <div class="w-12 h-12 rounded-lg bg-primary-light/10 text-secondary text-xl flex items-center justify-center">
                <i class="fas fa-briefcase"></i>
            </div>
        </div>

        <!-- Card 2 -->
        <div class="admin-card flex items-center justify-between">
            <div>
                <span class="text-text-muted text-xs font-semibold uppercase tracking-wider block mb-1">Team Members</span>
                <span class="text-3xl font-heading font-extrabold text-text-primary">{{ $teamCount }}</span>
            </div>
            <div class="w-12 h-12 rounded-lg bg-primary-light/10 text-secondary text-xl flex items-center justify-center">
                <i class="fas fa-users"></i>
            </div>
        </div>

        <!-- Card 3 -->
        <div class="admin-card flex items-center justify-between">
            <div>
                <span class="text-text-muted text-xs font-semibold uppercase tracking-wider block mb-1">Total Resources</span>
                <span class="text-3xl font-heading font-extrabold text-text-primary">{{ $downloadsCount }}</span>
            </div>
            <div class="w-12 h-12 rounded-lg bg-primary-light/10 text-secondary text-xl flex items-center justify-center">
                <i class="fas fa-file-alt"></i>
            </div>
        </div>

        <!-- Card 4 -->
        <div class="admin-card flex items-center justify-between">
            <div>
                <span class="text-text-muted text-xs font-semibold uppercase tracking-wider block mb-1">Messages In Inbox</span>
                <span class="text-3xl font-heading font-extrabold text-text-primary">{{ $messagesCount }}</span>
                @if($unreadMessagesCount > 0)
                    <span class="text-xs text-accent-coral ml-2 font-semibold">({{ $unreadMessagesCount }} unread)</span>
                @endif
            </div>
            <div class="w-12 h-12 rounded-lg bg-primary-light/10 text-secondary text-xl flex items-center justify-center">
                <i class="fas fa-envelope"></i>
            </div>
        </div>
    </div>

    <!-- Main split layout -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        
        <!-- Contact Messages segment -->
        <div class="admin-card flex flex-col">
            <div class="flex justify-between items-center mb-6">
                <h3 class="text-lg font-heading font-bold text-text-primary">Recent Inbox Messages</h3>
                <a href="/admin/messages" class="text-secondary hover:text-text-primary text-xs font-semibold">View Inbox</a>
            </div>

            <div class="flex flex-col gap-4 flex-grow">
                @forelse($latestMessages as $msg)
                    <div class="glass p-4 rounded-lg flex flex-col gap-2 {{ !$msg->is_read ? 'border-l-2 border-primary-accent bg-glass-light' : 'border-glass-border/20' }}">
                        <div class="flex justify-between items-center text-xs">
                            <span class="font-semibold text-text-primary">{{ $msg->name }}</span>
                            <span class="text-text-muted">{{ $msg->created_at->diffForHumans() }}</span>
                        </div>
                        <span class="text-text-secondary text-xs">{{ $msg->email }}</span>
                        <p class="text-text-secondary text-sm leading-relaxed truncate">{{ $msg->message }}</p>
                    </div>
                @empty
                    <div class="text-center py-12 text-text-secondary">
                        <i class="fas fa-envelope-open text-2xl mb-2 text-primary-muted"></i>
                        <p class="text-sm">Inbox is completely clean!</p>
                    </div>
                @endforelse
            </div>
        </div>

        <!-- Recent Projects segment -->
        <div class="admin-card flex flex-col">
            <div class="flex justify-between items-center mb-6">
                <h3 class="text-lg font-heading font-bold text-text-primary">Recent Projects Added</h3>
                <a href="/admin/projects" class="text-secondary hover:text-text-primary text-xs font-semibold">Manage Projects</a>
            </div>

            <div class="flex flex-col gap-4 flex-grow">
                @forelse($recentProjects as $proj)
                    <div class="glass p-4 rounded-lg flex items-center justify-between gap-4">
                        <div class="flex-grow min-w-0">
                            <h4 class="text-text-primary font-semibold text-sm truncate mb-1">{{ $proj->title }}</h4>
                            <span class="badge {{ $proj->status === 'ongoing' ? 'badge-ongoing' : 'badge-completed' }} text-[9px] py-0 px-2 uppercase">
                                {{ $proj->status }}
                            </span>
                        </div>
                        <a href="/admin/projects/{{ $proj->id }}/edit" class="text-text-muted hover:text-text-primary shrink-0"><i class="fas fa-edit"></i></a>
                    </div>
                @empty
                    <div class="text-center py-12 text-text-secondary">
                        <i class="fas fa-briefcase text-2xl mb-2 text-primary-muted"></i>
                        <p class="text-sm">No projects listed yet.</p>
                    </div>
                @endforelse
            </div>
        </div>

    </div>
@endsection
