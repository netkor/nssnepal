@extends('layouts.app')

@section('title', 'Natural Science Society (NSS) Nepal')

@section('content')
    <!-- Hero Section / Slider -->
    <div class="relative min-h-[90vh] flex items-center justify-center overflow-hidden">
        <!-- Slider Images Container -->
        @if($sliders->count() > 0)
            @foreach($sliders as $index => $slide)
                <div class="absolute inset-0 transition-opacity duration-1000 ease-in-out hero-slide {{ $index === 0 ? 'opacity-100 z-10' : 'opacity-0 z-0' }}" id="slide-{{ $index }}">
                    <!-- Overlay gradient -->
                    <div class="hero-overlay z-10"></div>
                    <!-- Background image -->
                    <div class="absolute inset-0 bg-cover bg-center bg-no-repeat" style="background-image: url('{{ $slide->image }}'); background-position: center 30%;"></div>
                    
                    <!-- Content -->
                    <div class="container mx-auto px-4 md:px-8 relative z-20 h-full flex flex-col justify-center min-h-[90vh]">
                        <div class="max-w-3xl animate-on-scroll">
                            <span class="text-secondary text-sm font-semibold tracking-widest uppercase mb-3 block">Natural Science Society Nepal</span>
                            <h1 class="text-4xl md:text-6xl font-heading font-extrabold text-white mb-6 leading-tight">
                                {{ $slide->title }}
                            </h1>
                            <p class="text-lg md:text-xl text-text-secondary mb-8 max-w-2xl">
                                {{ $slide->subtitle }}
                            </p>
                            @if($slide->button_text && $slide->button_url)
                                <a href="{{ $slide->button_url }}" class="btn-primary">
                                    {{ $slide->button_text }} <i class="fas fa-arrow-right ml-2 text-xs"></i>
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
            
            <!-- Slider Controls -->
            @if($sliders->count() > 1)
                <button class="absolute left-6 top-1/2 -translate-y-1/2 z-30 w-12 h-12 rounded-full glass border border-glass-border/30 hover:bg-primary-accent flex items-center justify-center text-white transition duration-300" onclick="prevSlide()">
                    <i class="fas fa-chevron-left"></i>
                </button>
                <button class="absolute right-6 top-1/2 -translate-y-1/2 z-30 w-12 h-12 rounded-full glass border border-glass-border/30 hover:bg-primary-accent flex items-center justify-center text-white transition duration-300" onclick="nextSlide()">
                    <i class="fas fa-chevron-right"></i>
                </button>
            @endif
        @else
            <!-- Fallback Slide -->
            <div class="absolute inset-0 hero-overlay z-10"></div>
            <div class="absolute inset-0 bg-cover bg-center bg-no-repeat" style="background-image: url('https://images.unsplash.com/photo-1547036967-23d11aacaee0?auto=format&fit=crop&w=1920&q=80');"></div>
            <div class="container mx-auto px-4 md:px-8 relative z-20 h-full flex flex-col justify-center min-h-[90vh]">
                <div class="max-w-3xl animate-on-scroll">
                    <span class="text-secondary text-sm font-semibold tracking-widest uppercase mb-3 block">Natural Science Society Nepal</span>
                    <h1 class="text-4xl md:text-6xl font-heading font-extrabold text-white mb-6 leading-tight">
                        Research & Conservation of Biodiversity
                    </h1>
                    <p class="text-lg md:text-xl text-text-secondary mb-8 max-w-2xl">
                        Dedicated to protecting Nepal's rich ecological heritage through scientific studies and public education.
                    </p>
                    <a href="/about-us" class="btn-primary">
                        Explore Our Mission <i class="fas fa-arrow-right ml-2 text-xs"></i>
                    </a>
                </div>
            </div>
        @endif
    </div>

    <!-- Overview / Focus Areas -->
    <section class="py-20 bg-dark-bg relative">
        <div class="container mx-auto px-4 md:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                <!-- Text block -->
                <div class="animate-on-scroll">
                    <span class="text-primary-muted font-bold text-xs uppercase tracking-widest block mb-2">Who We Are</span>
                    <h2 class="section-title text-white">Natural Science Society (NSS)</h2>
                    <div class="section-divider"></div>
                    <p class="text-text-secondary text-md mb-6 leading-relaxed">
                        NSS is a non-governmental organization based in Nepal. We are focused on research and conservation of biodiversity, environmental education, and building community-level conservation stewards.
                    </p>
                    <p class="text-text-secondary text-md mb-8 leading-relaxed">
                        We actively design awareness campaigns, monitor threatened wildlife populations (like common leopards, striped hyenas, and musk deer), and work closely with schools, buffer zone committees, and national parks.
                    </p>
                    <div class="flex flex-wrap gap-4">
                        <a href="/about-us" class="btn-secondary">
                            Our Objectives
                        </a>
                        <a href="/teams" class="btn-primary">
                            Meet Our Team <i class="fas fa-users ml-2 text-xs"></i>
                        </a>
                    </div>
                </div>

                <!-- Cards grid -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                    <div class="glass-card p-6 flex flex-col gap-4 animate-on-scroll delay-1">
                        <div class="w-12 h-12 rounded-lg bg-primary-light/20 flex items-center justify-center text-secondary text-xl">
                            <i class="fas fa-microscope"></i>
                        </div>
                        <h3 class="text-lg font-bold text-white">Scientific Research</h3>
                        <p class="text-text-secondary text-sm">
                            Conducting rigorous wildlife monitoring, habitat evaluations, and conflict mitigation studies.
                        </p>
                    </div>

                    <div class="glass-card p-6 flex flex-col gap-4 animate-on-scroll delay-2">
                        <div class="w-12 h-12 rounded-lg bg-primary-light/20 flex items-center justify-center text-secondary text-xl">
                            <i class="fas fa-graduation-cap"></i>
                        </div>
                        <h3 class="text-lg font-bold text-white">Environmental Education</h3>
                        <p class="text-text-secondary text-sm">
                            Empowering students, educators, and local groups with nature literacy and protection seminars.
                        </p>
                    </div>

                    <div class="glass-card p-6 flex flex-col gap-4 animate-on-scroll delay-3">
                        <div class="w-12 h-12 rounded-lg bg-primary-light/20 flex items-center justify-center text-secondary text-xl">
                            <i class="fas fa-hands-helping"></i>
                        </div>
                        <h3 class="text-lg font-bold text-white">Community Stewardship</h3>
                        <p class="text-text-secondary text-sm">
                            Training game-scouts, local committees, and young researchers to govern conservation locally.
                        </p>
                    </div>

                    <div class="glass-card p-6 flex flex-col gap-4 animate-on-scroll delay-4">
                        <div class="w-12 h-12 rounded-lg bg-primary-light/20 flex items-center justify-center text-secondary text-xl">
                            <i class="fas fa-book-open"></i>
                        </div>
                        <h3 class="text-lg font-bold text-white">Publications</h3>
                        <p class="text-text-secondary text-sm">
                            Sharing conservation data through international scientific publications and educational posters.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Stats Counters -->
    <section class="py-16 bg-dark-surface border-y border-glass-border/30">
        <div class="container mx-auto px-4 md:px-8">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-8">
                <div class="stat-item animate-on-scroll">
                    <div class="stat-number">4+</div>
                    <div class="stat-label">Active & Past Projects</div>
                </div>
                <div class="stat-item animate-on-scroll delay-1">
                    <div class="stat-number">10+</div>
                    <div class="stat-label">Scientific Articles</div>
                </div>
                <div class="stat-item animate-on-scroll delay-2">
                    <div class="stat-number">15+</div>
                    <div class="stat-label">Team Members</div>
                </div>
                <div class="stat-item animate-on-scroll delay-3">
                    <div class="stat-number">100s</div>
                    <div class="stat-label">Students Reached</div>
                </div>
            </div>
        </div>
    </section>

    <!-- Featured Projects -->
    <section class="py-20 bg-dark-bg">
        <div class="container mx-auto px-4 md:px-8">
            <div class="flex flex-col md:flex-row justify-between items-start md:items-end mb-12">
                <div class="animate-on-scroll">
                    <span class="text-primary-muted font-bold text-xs uppercase tracking-widest block mb-2">Our Field Initiatives</span>
                    <h2 class="text-3xl md:text-4xl font-heading font-bold text-white">Featured Projects</h2>
                    <div class="section-divider"></div>
                </div>
                <a href="/projects" class="btn-secondary py-2 px-6 flex items-center gap-2 hover:scale-105 transition-all text-sm">
                    View All Projects <i class="fas fa-chevron-right text-xs"></i>
                </a>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                @forelse($featuredProjects as $project)
                    <div class="project-card flex flex-col h-full animate-on-scroll">
                        <div class="card-image bg-primary-light/10 relative">
                            @if($project->featured_image)
                                <img src="{{ $project->featured_image }}" alt="{{ $project->title }}">
                            @else
                                <!-- Dynamic Nature Placeholder based on project ID -->
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
                                <img src="{{ $imgUrl }}" alt="{{ $project->title }}">
                            @endif
                            <div class="absolute top-4 right-4">
                                <span class="badge {{ $project->status === 'ongoing' ? 'badge-ongoing' : 'badge-completed' }}">
                                    {{ $project->status }}
                                </span>
                            </div>
                        </div>
                        <div class="p-6 flex flex-col flex-grow">
                            <h3 class="text-xl font-bold font-heading text-white mb-3 hover:text-secondary transition">
                                <a href="/projects/{{ $project->slug }}">{{ $project->title }}</a>
                            </h3>
                            <p class="text-text-secondary text-sm leading-relaxed mb-6 flex-grow">
                                {{ Str::limit($project->description, 130) }}
                            </p>
                            <a href="/projects/{{ $project->slug }}" class="text-secondary hover:text-white text-sm font-semibold flex items-center gap-1.5 mt-auto transition">
                                Read Project Details <i class="fas fa-arrow-right text-[10px]"></i>
                            </a>
                        </div>
                    </div>
                @empty
                    <div class="col-span-3 text-center py-12 text-text-secondary">
                        No projects seeded. Please run the content seeder.
                    </div>
                @endforelse
            </div>
        </div>
    </section>

    <!-- Support Us Banner -->
    <section class="py-20 bg-dark-bg relative overflow-hidden">
        <!-- Radial back drop -->
        <div class="absolute inset-0 bg-radial-to-t from-primary-light/10 to-transparent pointer-events-none"></div>
        <div class="container mx-auto px-4 md:px-8 relative z-10">
            <div class="glass-card p-8 md:p-12 max-w-5xl mx-auto flex flex-col lg:flex-row justify-between items-center gap-8">
                <div class="max-w-2xl animate-on-scroll">
                    <span class="text-accent-gold text-xs font-bold uppercase tracking-widest block mb-2">Contribute to Conservation</span>
                    <h2 class="text-2xl md:text-3xl font-heading font-bold text-white mb-4">Support Our Ecological Endeavors</h2>
                    <p class="text-text-secondary text-md leading-relaxed">
                        Natural Science Society (NSS) is sustained through memberships and donations from conservation organizations, grants, and people like you. Join us or support us through banking details.
                    </p>
                </div>
                <div class="flex flex-col sm:flex-row gap-4 shrink-0 w-full sm:w-auto animate-on-scroll">
                    <a href="/support-us" class="btn-gold text-center justify-center">
                        <i class="fas fa-heart mr-2"></i> Join / Donate
                    </a>
                    <a href="/opportunities" class="btn-secondary text-center justify-center border-glass-border hover:bg-glass-light">
                        Research Grants
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Partners & Collaborators -->
    @if($partners->count() > 0)
    <section class="py-16 bg-dark-surface border-t border-glass-border/30">
        <div class="container mx-auto px-4 md:px-8">
            <div class="text-center mb-12 animate-on-scroll">
                <span class="text-primary-muted font-bold text-xs uppercase tracking-widest block mb-2">Trusted By</span>
                <h2 class="text-3xl md:text-4xl font-heading font-bold text-white">Our Partners & Collaborators</h2>
                <div class="section-divider mx-auto"></div>
            </div>

            <div class="flex flex-wrap justify-center items-center gap-10 md:gap-16 max-w-4xl mx-auto animate-on-scroll">
                @foreach($partners as $partner)
                    @if($partner->logo)
                        @if($partner->url)
                            <a href="{{ $partner->url }}" target="_blank" rel="noopener noreferrer" class="partner-logo-item group" title="{{ $partner->name }}">
                                <img src="{{ $partner->logo }}" alt="{{ $partner->name }}" class="partner-logo">
                                <span class="partner-name">{{ $partner->name }}</span>
                            </a>
                        @else
                            <div class="partner-logo-item" title="{{ $partner->name }}">
                                <img src="{{ $partner->logo }}" alt="{{ $partner->name }}" class="partner-logo">
                                <span class="partner-name">{{ $partner->name }}</span>
                            </div>
                        @endif
                    @else
                        @if($partner->url)
                            <a href="{{ $partner->url }}" target="_blank" rel="noopener noreferrer" class="partner-text-item group" title="{{ $partner->name }}">
                                <span class="text-white font-heading font-bold text-lg group-hover:text-secondary transition">{{ $partner->name }}</span>
                            </a>
                        @else
                            <div class="partner-text-item" title="{{ $partner->name }}">
                                <span class="text-white font-heading font-bold text-lg">{{ $partner->name }}</span>
                            </div>
                        @endif
                    @endif
                @endforeach
            </div>
        </div>
    </section>
    @endif

    <!-- Latest News / Events -->
    <section class="py-20 bg-dark-surface border-t border-glass-border/30">
        <div class="container mx-auto px-4 md:px-8">
            <div class="flex flex-col md:flex-row justify-between items-start md:items-end mb-12">
                <div class="animate-on-scroll">
                    <span class="text-primary-muted font-bold text-xs uppercase tracking-widest block mb-2">Announcements & Programs</span>
                    <h2 class="text-3xl md:text-4xl font-heading font-bold text-white">News & Events</h2>
                    <div class="section-divider"></div>
                </div>
                <a href="/news-and-events" class="btn-secondary py-2 px-6 flex items-center gap-2 hover:scale-105 transition-all text-sm">
                    View More News <i class="fas fa-chevron-right text-xs"></i>
                </a>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                @forelse($latestNews as $article)
                    <div class="glass-card flex flex-col h-full animate-on-scroll overflow-hidden">
                        <div class="h-48 overflow-hidden bg-primary-light/5 relative">
                            @if($article->featured_image)
                                <img src="{{ $article->featured_image }}" alt="{{ $article->title }}" class="w-full h-full object-cover">
                            @else
                                <img src="https://images.unsplash.com/photo-1444464666168-49d633b86797?auto=format&fit=crop&w=800&q=80" alt="{{ $article->title }}" class="w-full h-full object-cover">
                            @endif
                            <div class="absolute top-4 left-4 bg-primary-accent text-white text-[10px] font-bold px-2 py-0.5 rounded-full uppercase tracking-wider">
                                {{ $article->type }}
                            </div>
                        </div>
                        <div class="p-6 flex flex-col flex-grow">
                            <span class="text-text-muted text-xs mb-2 block"><i class="fas fa-calendar-alt mr-1"></i> {{ $article->published_at?->format('M d, Y') ?? $article->created_at->format('M d, Y') }}</span>
                            <h3 class="text-lg font-bold font-heading text-white mb-3 hover:text-secondary transition">
                                <a href="/news-and-events/{{ $article->slug }}">{{ $article->title }}</a>
                            </h3>
                            <p class="text-text-secondary text-sm leading-relaxed mb-4 flex-grow">
                                {{ Str::limit($article->excerpt, 110) }}
                            </p>
                            <a href="/news-and-events/{{ $article->slug }}" class="text-secondary hover:text-white text-xs font-semibold flex items-center gap-1.5 transition">
                                Read Article <i class="fas fa-arrow-right text-[9px]"></i>
                            </a>
                        </div>
                    </div>
                @empty
                    <div class="col-span-3 text-center py-12 text-text-secondary">
                        No recent news posted.
                    </div>
                @endforelse
            </div>
        </div>
    </section>
@endsection

@section('scripts')
    <script>
        let currentSlide = 0;
        const slides = document.querySelectorAll('.hero-slide');
        
        function showSlide(index) {
            if (slides.length === 0) return;
            
            slides[currentSlide].classList.remove('opacity-100', 'z-10');
            slides[currentSlide].classList.add('opacity-0', 'z-0');
            
            currentSlide = (index + slides.length) % slides.length;
            
            slides[currentSlide].classList.remove('opacity-0', 'z-0');
            slides[currentSlide].classList.add('opacity-100', 'z-10');
        }
        
        function nextSlide() {
            showSlide(currentSlide + 1);
        }
        
        function prevSlide() {
            showSlide(currentSlide - 1);
        }
        
        // Auto slide change
        setInterval(nextSlide, 7000);
    </script>
@endsection
