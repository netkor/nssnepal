@extends('layouts.app')

@section('title', 'Research Projects | Natural Science Society (NSS) Nepal')

@section('content')
    <!-- Banner Page Header -->
    <header class="page-header">
        <div class="container mx-auto px-4 md:px-8 relative z-10">
            <span class="text-secondary text-sm font-semibold tracking-widest uppercase mb-2 block">Our Initiatives</span>
            <h1 class="text-4xl md:text-5xl font-heading font-extrabold text-white">Conservation Projects</h1>
            <div class="section-divider mx-auto"></div>
        </div>
    </header>

    <!-- Project List Section -->
    <section class="py-20 bg-dark-bg">
        <div class="container mx-auto px-4 md:px-8">
            
            <!-- Filters & Search -->
            <div class="flex flex-col lg:flex-row justify-between items-center mb-16 animate-on-scroll gap-6">
                <!-- Filters tab -->
                <div class="glass p-1.5 rounded-xl flex gap-2 overflow-x-auto w-full lg:w-auto pb-1">
                    <a href="{{ route('projects.index', ['search' => request('search')]) }}" class="px-6 py-2.5 rounded-lg text-sm font-semibold transition duration-300 whitespace-nowrap {{ is_null($status) ? 'bg-primary text-white shadow' : 'text-text-secondary hover:text-white' }}">
                        All Projects
                    </a>
                    <a href="{{ route('projects.index', ['status' => 'ongoing', 'search' => request('search')]) }}" class="px-6 py-2.5 rounded-lg text-sm font-semibold transition duration-300 whitespace-nowrap {{ $status === 'ongoing' ? 'bg-primary text-white shadow' : 'text-text-secondary hover:text-white' }}">
                        Ongoing
                    </a>
                    <a href="{{ route('projects.index', ['status' => 'completed', 'search' => request('search')]) }}" class="px-6 py-2.5 rounded-lg text-sm font-semibold transition duration-300 whitespace-nowrap {{ $status === 'completed' ? 'bg-primary text-white shadow' : 'text-text-secondary hover:text-white' }}">
                        Completed
                    </a>
                </div>
                
                <!-- Search Box -->
                <form action="{{ route('projects.index') }}" method="GET" class="relative w-full lg:w-auto">
                    @if(request('status'))
                        <input type="hidden" name="status" value="{{ request('status') }}">
                    @endif
                    <input type="text" name="search" placeholder="Search projects..." value="{{ request('search') }}" class="w-full lg:w-80 bg-glass-light/10 border border-glass-border/30 rounded-xl py-3 px-5 text-white focus:outline-none focus:border-secondary focus:ring-1 focus:ring-secondary transition placeholder-text-muted">
                    <button type="submit" class="absolute right-4 top-1/2 -translate-y-1/2 text-text-muted hover:text-secondary transition">
                        <i class="fas fa-search"></i>
                    </button>
                </form>
            </div>

            <!-- Cards grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-8 max-w-5xl mx-auto">
                @forelse($projects as $project)
                    <div class="project-card flex flex-col h-full animate-on-scroll">
                        <div class="card-image bg-primary-light/10 relative">
                            @if($project->featured_image)
                                <img src="{{ $project->featured_image }}" alt="{{ $project->title }}" loading="lazy" class="w-full h-full object-cover">
                            @else
                                <!-- Dynamic nature placeholder depending on title content -->
                                @php
                                    $imgUrl = 'https://images.unsplash.com/photo-1547036967-23d11aacaee0?auto=format&fit=crop&w=800&q=80';
                                    if(str_contains(strtolower($project->title), 'hyena')) {
                                        $imgUrl = 'https://images.unsplash.com/photo-1590420485404-f86d22b8abf8?auto=format&fit=crop&w=800&q=80';
                                    } elseif (str_contains(strtolower($project->title), 'deer')) {
                                        $imgUrl = 'https://images.unsplash.com/photo-1507666405495-42218538c235?auto=format&fit=crop&w=800&q=80';
                                    } elseif (str_contains(strtolower($project->title), 'tiger')) {
                                        $imgUrl = 'https://images.unsplash.com/photo-1602491453979-02654b52c208?auto=format&fit=crop&w=800&q=80';
                                    }
                                @endphp
                                <img src="{{ $imgUrl }}" alt="{{ $project->title }}" loading="lazy" class="w-full h-full object-cover">
                            @endif
                            <div class="absolute top-4 right-4">
                                <span class="badge {{ $project->status === 'ongoing' ? 'badge-ongoing' : 'badge-completed' }}">
                                    {{ $project->status }}
                                </span>
                            </div>
                        </div>
                        <div class="p-8 flex flex-col flex-grow">
                            <h3 class="text-2xl font-bold font-heading text-white mb-4 hover:text-secondary transition">
                                <a href="/projects/{{ $project->slug }}">{{ $project->title }}</a>
                            </h3>
                            <p class="text-text-secondary text-sm leading-relaxed mb-6 flex-grow">
                                {{ $project->description }}
                            </p>
                            <a href="/projects/{{ $project->slug }}" class="text-secondary hover:text-white text-sm font-semibold flex items-center gap-1.5 mt-auto transition">
                                View Full Project Details <i class="fas fa-arrow-right text-[10px]"></i>
                            </a>
                        </div>
                    </div>
                @empty
                    <div class="col-span-2 text-center py-16 text-text-secondary glass-card">
                        <i class="fas fa-search text-3xl mb-4 text-primary-muted"></i>
                        <p>No projects found matching the filter.</p>
                    </div>
                @endforelse
            </div>

            <!-- Pagination -->
            @if($projects->hasPages())
                <div class="max-w-5xl mx-auto flex justify-center mt-12">
                    <div class="glass p-2 rounded-xl border border-glass-border/30">
                        {{ $projects->links() }}
                    </div>
                </div>
            @endif

        </div>
    </section>
@endsection
