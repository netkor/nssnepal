@extends('layouts.app')

@section('title', 'News & Events | Natural Science Society (NSS) Nepal')

@section('content')
    <!-- Banner Page Header -->
    <header class="page-header">
        <div class="container mx-auto px-4 md:px-8 relative z-10">
            <span class="text-secondary text-sm font-semibold tracking-widest uppercase mb-2 block">Announcements</span>
            <h1 class="text-4xl md:text-5xl font-heading font-extrabold text-text-primary">News & Events</h1>
            <div class="section-divider mx-auto"></div>
        </div>
    </header>

    <!-- News List Section -->
    <section class="py-20 bg-dark-bg">
        <div class="container mx-auto px-4 md:px-8">
            <!-- Filters & Search -->
            <div class="flex flex-col lg:flex-row justify-between items-center mb-16 animate-on-scroll gap-6 max-w-5xl mx-auto">
                <!-- Filters tab -->
                <div class="glass p-1.5 rounded-xl flex gap-2 overflow-x-auto w-full lg:w-auto pb-1">
                    <a href="{{ route('news.index', ['search' => request('search')]) }}" class="px-6 py-2.5 rounded-lg text-sm font-semibold transition duration-300 whitespace-nowrap {{ empty(request('type')) ? 'bg-primary text-dark-bg shadow' : 'text-text-secondary hover:text-text-primary' }}">
                        All Updates
                    </a>
                    <a href="{{ route('news.index', ['type' => 'news', 'search' => request('search')]) }}" class="px-6 py-2.5 rounded-lg text-sm font-semibold transition duration-300 whitespace-nowrap {{ request('type') === 'news' ? 'bg-primary text-dark-bg shadow' : 'text-text-secondary hover:text-text-primary' }}">
                        News
                    </a>
                    <a href="{{ route('news.index', ['type' => 'event', 'search' => request('search')]) }}" class="px-6 py-2.5 rounded-lg text-sm font-semibold transition duration-300 whitespace-nowrap {{ request('type') === 'event' ? 'bg-primary text-dark-bg shadow' : 'text-text-secondary hover:text-text-primary' }}">
                        Events
                    </a>
                </div>
                
                <!-- Search Box -->
                <form action="{{ route('news.index') }}" method="GET" class="relative w-full lg:w-auto">
                    @if(request('type'))
                        <input type="hidden" name="type" value="{{ request('type') }}">
                    @endif
                    <input type="text" name="search" placeholder="Search news & events..." value="{{ request('search') }}" class="w-full lg:w-80 bg-glass-light/10 border border-glass-border/30 rounded-xl py-3 px-5 text-text-primary focus:outline-none focus:border-secondary focus:ring-1 focus:ring-secondary transition placeholder-text-muted">
                    <button type="submit" class="absolute right-4 top-1/2 -translate-y-1/2 text-text-muted hover:text-secondary transition">
                        <i class="fas fa-search"></i>
                    </button>
                </form>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 max-w-5xl mx-auto mb-12">
                @forelse($articles as $article)
                    <div class="glass-card flex flex-col h-full overflow-hidden animate-on-scroll">
                        <div class="h-48 bg-primary-light/5 overflow-hidden relative">
                            @if($article->featured_image)
                                <img src="{{ $article->featured_image }}" alt="{{ $article->title }}" loading="lazy" class="w-full h-full object-cover">
                            @else
                                <img src="https://images.unsplash.com/photo-1444464666168-49d633b86797?auto=format&fit=crop&w=800&q=80" alt="{{ $article->title }}" loading="lazy" class="w-full h-full object-cover">
                            @endif
                            <div class="absolute top-4 left-4 bg-primary-accent text-text-primary text-[10px] font-bold px-2.5 py-0.5 rounded-full uppercase tracking-wider">
                                {{ $article->type }}
                            </div>
                        </div>
                        <div class="p-6 flex flex-col flex-grow">
                            <span class="text-text-muted text-xs mb-2 block"><i class="fas fa-calendar-alt mr-1"></i> {{ $article->published_at?->format('M d, Y') ?? $article->created_at->format('M d, Y') }}</span>
                            <h3 class="text-lg font-bold font-heading text-text-primary mb-3 hover:text-secondary transition">
                                <a href="/news-and-events/{{ $article->slug }}">{{ $article->title }}</a>
                            </h3>
                            @if($article->excerpt)
                                <p class="text-text-secondary text-sm leading-relaxed mb-4 flex-grow">
                                    {{ Str::limit($article->excerpt, 120) }}
                                </p>
                            @endif
                            <a href="/news-and-events/{{ $article->slug }}" class="text-secondary hover:text-text-primary text-xs font-semibold flex items-center gap-1.5 mt-auto transition">
                                Read Full Article <i class="fas fa-arrow-right text-[9px]"></i>
                            </a>
                        </div>
                    </div>
                @empty
                    <div class="col-span-3 text-center py-16 text-text-secondary glass-card">
                        <i class="fas fa-bullhorn text-3xl mb-4 text-primary-muted"></i>
                        <p>No recent news or events posted yet.</p>
                    </div>
                @endforelse
            </div>

            <!-- Custom Pagination -->
            @if($articles->hasPages())
                <div class="max-w-5xl mx-auto flex justify-center mt-12">
                    <div class="glass p-2 rounded-xl border border-glass-border/30">
                        {{ $articles->links() }}
                    </div>
                </div>
            @endif

        </div>
    </section>
@endsection
