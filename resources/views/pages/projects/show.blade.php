@extends('layouts.app')

@section('title', $project->title . ' | Projects | NSS Nepal')
@section('og_type', 'article')
@section('og_title', $project->title)
@section('meta_description', \Illuminate\Support\Str::limit(strip_tags($project->description), 160))
@section('og_description', strip_tags($project->description))
@if($project->featured_image)
    @section('og_image', asset($project->featured_image))
@endif

@section('content')
    <!-- Banner Page Header -->
    <header class="page-header relative overflow-hidden">
        <div class="container mx-auto px-4 md:px-8 relative z-10 text-left max-w-4xl">
            <a href="/projects" class="text-secondary hover:text-white text-sm font-semibold flex items-center gap-2 mb-6 transition">
                <i class="fas fa-arrow-left"></i> Back to Projects
            </a>
            <span class="badge {{ $project->status === 'ongoing' ? 'badge-ongoing' : 'badge-completed' }} mb-4">
                {{ $project->status }}
            </span>
            <h1 class="text-3xl md:text-5xl font-heading font-extrabold text-white mb-4 leading-tight">
                {{ $project->title }}
            </h1>
            <div class="section-divider"></div>
        </div>
    </header>

    <!-- Detail Content Section -->
    <section class="py-20 bg-dark-bg">
        <div class="container mx-auto px-4 md:px-8 max-w-4xl">
            
            <!-- Featured Image -->
            <div class="rounded-2xl overflow-hidden mb-12 border border-glass-border/30 shadow-2xl bg-primary-light/5 max-h-[500px]">
                @if($project->featured_image)
                    <img src="{{ $project->featured_image }}" alt="{{ $project->title }}" class="w-full h-full object-cover">
                @else
                    @php
                        $imgUrl = 'https://images.unsplash.com/photo-1547036967-23d11aacaee0?auto=format&fit=crop&w=1200&q=80';
                        if(str_contains(strtolower($project->title), 'hyena')) {
                            $imgUrl = 'https://images.unsplash.com/photo-1590420485404-f86d22b8abf8?auto=format&fit=crop&w=1200&q=80';
                        } elseif (str_contains(strtolower($project->title), 'deer')) {
                            $imgUrl = 'https://images.unsplash.com/photo-1507666405495-42218538c235?auto=format&fit=crop&w=1200&q=80';
                        } elseif (str_contains(strtolower($project->title), 'tiger')) {
                            $imgUrl = 'https://images.unsplash.com/photo-1602491453979-02654b52c208?auto=format&fit=crop&w=1200&q=80';
                        }
                    @endphp
                    <img src="{{ $imgUrl }}" alt="{{ $project->title }}" class="w-full h-full object-cover">
                @endif
            </div>

            <!-- Description summary box -->
            @if($project->description)
                <div class="glass p-6 md:p-8 rounded-xl border border-primary-accent/20 mb-12 animate-on-scroll">
                    <h3 class="text-white font-heading font-semibold text-lg mb-2">Project Brief Summary</h3>
                    <p class="text-text-secondary text-md leading-relaxed italic">
                        "{{ $project->description }}"
                    </p>
                </div>
            @endif

            <!-- Rich Text Body -->
            <article class="prose prose-invert max-w-none text-text-secondary leading-relaxed animate-on-scroll">
                {!! $project->content !!}
            </article>

            <!-- Bottom Action banner -->
            <div class="border-t border-glass-border/30 mt-16 pt-8 flex justify-between items-center">
                <a href="/projects" class="btn-secondary py-2.5 px-6">
                    <i class="fas fa-arrow-left"></i> View Other Projects
                </a>
                <a href="/support-us" class="btn-primary py-2.5 px-6 bg-gradient-to-r from-primary-light to-primary-accent rounded-lg flex items-center gap-2">
                    <i class="fas fa-heart text-secondary"></i> Support This Work
                </a>
            </div>

        </div>
    </section>
@endsection
