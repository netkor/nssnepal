@extends('layouts.app')

@section('title', $newsEvent->title . ' | News & Events | NSS Nepal')
@section('og_type', 'article')
@section('og_title', $newsEvent->title)
@section('meta_description', strip_tags($newsEvent->excerpt ?? \Illuminate\Support\Str::limit($newsEvent->content, 160)))
@section('og_description', strip_tags($newsEvent->excerpt ?? \Illuminate\Support\Str::limit($newsEvent->content, 150)))
@if($newsEvent->featured_image)
    @section('og_image', asset($newsEvent->featured_image))
@endif

@section('content')
    <!-- Banner Page Header -->
    <header class="page-header relative overflow-hidden">
        <div class="container mx-auto px-4 md:px-8 relative z-10 text-left max-w-4xl">
            <a href="/news-and-events" class="text-secondary hover:text-text-primary text-sm font-semibold flex items-center gap-2 mb-6 transition">
                <i class="fas fa-arrow-left"></i> Back to Announcements
            </a>
            <div class="flex items-center gap-3 mb-4">
                <span class="bg-primary-accent text-text-primary text-[10px] font-bold px-2.5 py-0.5 rounded-full uppercase tracking-wider">
                    {{ $newsEvent->type }}
                </span>
                <span class="text-text-muted text-xs"><i class="fas fa-calendar-alt mr-1"></i> {{ $newsEvent->published_at?->format('M d, Y') ?? $newsEvent->created_at->format('M d, Y') }}</span>
            </div>
            <h1 class="text-3xl md:text-5xl font-heading font-extrabold text-text-primary mb-4 leading-tight">
                {{ $newsEvent->title }}
            </h1>
            <div class="section-divider"></div>
        </div>
    </header>

    <!-- Detail News Section -->
    <section class="py-20 bg-dark-bg">
        <div class="container mx-auto px-4 md:px-8 max-w-4xl">
            
            <!-- Featured Image -->
            <div class="rounded-2xl overflow-hidden mb-12 border border-glass-border/30 shadow-2xl bg-primary-light/5 max-h-[480px]">
                @if($newsEvent->featured_image)
                    <img src="{{ $newsEvent->featured_image }}" alt="{{ $newsEvent->title }}" class="w-full h-full object-cover">
                @else
                    <img src="https://images.unsplash.com/photo-1444464666168-49d633b86797?auto=format&fit=crop&w=1200&q=80" alt="{{ $newsEvent->title }}" class="w-full h-full object-cover">
                @endif
            </div>

            <!-- Rich Content -->
            <article class="prose prose-invert max-w-none text-text-secondary leading-relaxed mb-16 animate-on-scroll">
                {!! $newsEvent->content !!}
            </article>

            <!-- Related articles sidebar grid -->
            @if($related->count() > 0)
                <div class="border-t border-glass-border/30 pt-16 mt-16">
                    <h3 class="text-2xl font-bold font-heading text-text-primary mb-8">Related Announcements</h3>
                    
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                        @foreach($related as $art)
                            <div class="glass-card flex flex-col h-full overflow-hidden">
                                <div class="h-32 bg-primary-light/5 overflow-hidden relative">
                                    @if($art->featured_image)
                                        <img src="{{ $art->featured_image }}" alt="{{ $art->title }}" class="w-full h-full object-cover">
                                    @else
                                        <img src="https://images.unsplash.com/photo-1444464666168-49d633b86797?auto=format&fit=crop&w=800&q=80" alt="{{ $art->title }}" class="w-full h-full object-cover">
                                    @endif
                                </div>
                                <div class="p-4 flex flex-col flex-grow">
                                    <h4 class="text-sm font-bold font-heading text-text-primary mb-2 line-clamp-2 hover:text-secondary transition">
                                        <a href="/news-and-events/{{ $art->slug }}">{{ $art->title }}</a>
                                    </h4>
                                    <span class="text-text-muted text-[10px] block mt-auto">{{ $art->published_at?->format('M d, Y') ?? $art->created_at->format('M d, Y') }}</span>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

        </div>
    </section>
@endsection
