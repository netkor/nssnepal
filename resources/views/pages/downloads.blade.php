@extends('layouts.app')

@section('title', 'Downloads & Resources | Natural Science Society (NSS) Nepal')

@section('content')
    <!-- Banner Page Header -->
    <header class="page-header">
        <div class="container mx-auto px-4 md:px-8 relative z-10">
            <span class="text-secondary text-sm font-semibold tracking-widest uppercase mb-2 block">Resources</span>
            <h1 class="text-4xl md:text-5xl font-heading font-extrabold text-text-primary">Downloads</h1>
            <div class="section-divider mx-auto"></div>
        </div>
    </header>

    <!-- Downloads Tab Section -->
    <section class="py-20 bg-dark-bg">
        <div class="container mx-auto px-4 md:px-8">
            
            <!-- Filters & Search -->
            <div class="flex flex-col lg:flex-row justify-between items-center mb-16 animate-on-scroll gap-6 max-w-4xl mx-auto">
                <!-- Filters tab -->
                <div class="glass p-1.5 rounded-xl flex gap-2 overflow-x-auto w-full lg:w-auto pb-1">
                    <a href="{{ route('downloads.publications', ['search' => request('search')]) }}" class="px-6 py-2.5 rounded-lg text-sm font-semibold transition duration-300 whitespace-nowrap {{ $type === 'publications' ? 'bg-primary text-dark-bg shadow' : 'text-text-secondary hover:text-text-primary' }}">
                        Scientific Publications
                    </a>
                    <a href="{{ route('downloads.reports', ['search' => request('search')]) }}" class="px-6 py-2.5 rounded-lg text-sm font-semibold transition duration-300 whitespace-nowrap {{ $type === 'reports' ? 'bg-primary text-dark-bg shadow' : 'text-text-secondary hover:text-text-primary' }}">
                        Annual Reports
                    </a>
                </div>
                
                <!-- Search Box -->
                <form action="{{ $type === 'publications' ? route('downloads.publications') : route('downloads.reports') }}" method="GET" class="relative w-full lg:w-auto">
                    <input type="text" name="search" placeholder="Search resources..." value="{{ request('search') }}" class="w-full lg:w-80 bg-glass-light/10 border border-glass-border/30 rounded-xl py-3 px-5 text-text-primary focus:outline-none focus:border-secondary focus:ring-1 focus:ring-secondary transition placeholder-text-muted">
                    <button type="submit" class="absolute right-4 top-1/2 -translate-y-1/2 text-text-muted hover:text-secondary transition">
                        <i class="fas fa-search"></i>
                    </button>
                </form>
            </div>

            <!-- List table/grid -->
            <div class="max-w-5xl mx-auto flex flex-col gap-6">
                @forelse($downloads as $file)
                    <div class="glass-card p-6 md:p-8 flex flex-col md:flex-row justify-between items-start md:items-center gap-6 animate-on-scroll">
                        <div class="flex-grow">
                            <!-- Header tags -->
                            <div class="flex items-center gap-3 mb-3">
                                <span class="badge badge-ongoing">
                                    {{ $file->type }}
                                </span>
                                @if($file->year)
                                    <span class="text-text-muted text-xs font-semibold"><i class="fas fa-calendar-day mr-1"></i> {{ $file->year }}</span>
                                @endif
                                @if($file->download_count > 0)
                                    <span class="text-text-muted text-xs"><i class="fas fa-eye mr-1"></i> {{ $file->download_count }} Reads</span>
                                @endif
                            </div>

                            <h3 class="text-xl font-bold font-heading text-text-primary mb-2 leading-snug">
                                {{ $file->title }}
                            </h3>

                            @if($file->authors)
                                <p class="text-secondary text-xs font-semibold mb-2">
                                    <i class="fas fa-pen-nib mr-1 text-primary-muted"></i> Authors: {{ $file->authors }}
                                </p>
                            @endif

                            @if($file->journal)
                                <p class="text-text-muted text-xs mb-3 italic">
                                    <i class="fas fa-book mr-1"></i> Published in: {{ $file->journal }}
                                </p>
                            @endif

                            @if($file->description)
                                <p class="text-text-secondary text-sm leading-relaxed max-w-3xl">
                                    {{ $file->description }}
                                </p>
                            @endif
                        </div>

                        <!-- Button trigger -->
                        <div class="shrink-0 w-full md:w-auto">
                            @if(str_starts_with($file->file_path, 'http') || str_starts_with($file->file_path, 'https'))
                                <a href="{{ $file->file_path }}" target="_blank" class="btn-primary w-full text-center justify-center py-2.5 px-6 flex items-center gap-2">
                                    <i class="fas fa-external-link-alt text-secondary"></i> Access Publisher
                                </a>
                            @else
                                <a href="/downloads/{{ $file->id }}/get" class="btn-primary w-full text-center justify-center py-2.5 px-6 flex items-center gap-2">
                                    <i class="fas fa-download text-secondary"></i> Download Document
                                </a>
                            @endif
                        </div>
                    </div>
                @empty
                    <div class="text-center py-16 text-text-secondary glass-card">
                        <i class="fas fa-file-pdf text-4xl mb-4 text-primary-muted"></i>
                        <h3 class="text-lg font-bold text-text-primary mb-1">No Files Found</h3>
                        <p class="text-sm">Please check back later or contact the office administration.</p>
                    </div>
                @endforelse
            </div>

            <!-- Pagination -->
            @if($downloads->hasPages())
                <div class="max-w-5xl mx-auto flex justify-center mt-12">
                    <div class="glass p-2 rounded-xl border border-glass-border/30">
                        {{ $downloads->links() }}
                    </div>
                </div>
            @endif

        </div>
    </section>
@endsection
