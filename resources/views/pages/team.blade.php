@extends('layouts.app')

@section('title', 'Our Team | Natural Science Society (NSS) Nepal')

@section('content')
    <!-- Banner Page Header -->
    <header class="page-header">
        <div class="container mx-auto px-4 md:px-8 relative z-10">
            <span class="text-secondary text-sm font-semibold tracking-widest uppercase mb-2 block">Our People</span>
            <h1 class="text-4xl md:text-5xl font-heading font-extrabold text-text-primary">Meet the Team</h1>
            <div class="section-divider mx-auto"></div>
        </div>
    </header>

    <!-- Team Content Section -->
    <section class="py-20 bg-dark-bg">
        <div class="container mx-auto px-4 md:px-8">
            
            <!-- Advisors Group -->
            @if($advisors->count() > 0)
                <div class="mb-20">
                    <div class="text-center mb-12 animate-on-scroll">
                        <span class="text-primary-muted font-bold text-xs uppercase tracking-widest block mb-2">Scientific Guidance</span>
                        <h2 class="text-3xl font-heading font-bold text-text-primary">Board of Advisors</h2>
                        <div class="section-divider mx-auto"></div>
                    </div>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 max-w-4xl mx-auto gap-8">
                        @foreach($advisors as $member)
                            @php
                                $cleanName = preg_replace('/^(Mr\.|Ms\.|Dr\.|Prof\.|Mrs\.)\s+/i', '', $member->name);
                                $initial = strtoupper(substr($cleanName, 0, 1));
                            @endphp
                            <div class="team-card flex flex-col items-center animate-on-scroll">
                                @if($member->photo)
                                    <img src="{{ $member->photo }}" alt="{{ $member->name }}" loading="lazy" class="w-24 h-24 rounded-full object-cover mb-4 border-2 border-secondary/20 shadow-lg">
                                @else
                                    <div class="w-24 h-24 rounded-full bg-gradient-to-tr from-primary-light to-primary-accent flex items-center justify-center text-text-primary text-3xl font-bold font-heading mb-4 border-2 border-secondary/20 shadow-lg">
                                        {{ $initial }}
                                    </div>
                                @endif
                                <h3 class="text-xl font-bold text-text-primary mb-1">{{ $member->name }}</h3>
                                <p class="text-secondary text-sm font-medium mb-3">{{ $member->designation }}</p>
                                @if($member->country)
                                    <span class="text-text-muted text-xs text-center"><i class="fas fa-university mr-1"></i> {{ $member->country }}</span>
                                @endif
                                <div class="flex items-center gap-3 mt-4">
                                    @if($member->email)
                                        <a href="mailto:{{ $member->email }}" class="w-8 h-8 rounded-full bg-primary-light/10 border border-glass-border/30 flex items-center justify-center text-text-secondary hover:text-secondary hover:border-secondary/50 transition-colors" title="Email">
                                            <i class="fas fa-envelope text-xs"></i>
                                        </a>
                                    @endif
                                    @if($member->phone)
                                        <a href="tel:{{ $member->phone }}" class="w-8 h-8 rounded-full bg-primary-light/10 border border-glass-border/30 flex items-center justify-center text-text-secondary hover:text-secondary hover:border-secondary/50 transition-colors" title="Phone">
                                            <i class="fas fa-phone-alt text-xs"></i>
                                        </a>
                                    @endif
                                    @if($member->google_scholar_url)
                                        <a href="{{ $member->google_scholar_url }}" target="_blank" class="w-8 h-8 rounded-full bg-primary-light/10 border border-glass-border/30 flex items-center justify-center text-text-secondary hover:text-secondary hover:border-secondary/50 transition-colors" title="Google Scholar">
                                            <i class="fas fa-graduation-cap text-xs"></i>
                                        </a>
                                    @endif
                                    @if($member->research_gate_url)
                                        <a href="{{ $member->research_gate_url }}" target="_blank" class="w-8 h-8 rounded-full bg-primary-light/10 border border-glass-border/30 flex items-center justify-center text-text-secondary hover:text-secondary hover:border-secondary/50 transition-colors" title="ResearchGate">
                                            <i class="fab fa-researchgate text-xs"></i>
                                        </a>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

            <!-- Executive Board Group -->
            @if($executives->count() > 0)
                <div class="mb-20">
                    <div class="text-center mb-12 animate-on-scroll">
                        <span class="text-primary-muted font-bold text-xs uppercase tracking-widest block mb-2">Governance Board</span>
                        <h2 class="text-3xl font-heading font-bold text-text-primary">Executive Members</h2>
                        <div class="section-divider mx-auto"></div>
                    </div>
                    
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                        @foreach($executives as $member)
                            @php
                                $cleanName = preg_replace('/^(Mr\.|Ms\.|Dr\.|Prof\.|Mrs\.)\s+/i', '', $member->name);
                                $initial = strtoupper(substr($cleanName, 0, 1));
                            @endphp
                            <div class="team-card flex flex-col items-center animate-on-scroll">
                                @if($member->photo)
                                    <img src="{{ $member->photo }}" alt="{{ $member->name }}" loading="lazy" class="w-24 h-24 rounded-full object-cover mb-4 border-2 border-secondary/20 shadow-lg">
                                @else
                                    <div class="w-24 h-24 rounded-full bg-gradient-to-tr from-primary-light to-primary-accent flex items-center justify-center text-text-primary text-3xl font-bold font-heading mb-4 border-2 border-secondary/20 shadow-lg">
                                        {{ $initial }}
                                    </div>
                                @endif
                                <h3 class="text-lg font-bold text-text-primary mb-1">{{ $member->name }}</h3>
                                <p class="text-secondary text-sm font-medium">{{ $member->designation }}</p>
                                <div class="flex items-center gap-3 mt-4">
                                    @if($member->email)
                                        <a href="mailto:{{ $member->email }}" class="w-8 h-8 rounded-full bg-primary-light/10 border border-glass-border/30 flex items-center justify-center text-text-secondary hover:text-secondary hover:border-secondary/50 transition-colors" title="Email">
                                            <i class="fas fa-envelope text-xs"></i>
                                        </a>
                                    @endif
                                    @if($member->phone)
                                        <a href="tel:{{ $member->phone }}" class="w-8 h-8 rounded-full bg-primary-light/10 border border-glass-border/30 flex items-center justify-center text-text-secondary hover:text-secondary hover:border-secondary/50 transition-colors" title="Phone">
                                            <i class="fas fa-phone-alt text-xs"></i>
                                        </a>
                                    @endif
                                    @if($member->google_scholar_url)
                                        <a href="{{ $member->google_scholar_url }}" target="_blank" class="w-8 h-8 rounded-full bg-primary-light/10 border border-glass-border/30 flex items-center justify-center text-text-secondary hover:text-secondary hover:border-secondary/50 transition-colors" title="Google Scholar">
                                            <i class="fas fa-graduation-cap text-xs"></i>
                                        </a>
                                    @endif
                                    @if($member->research_gate_url)
                                        <a href="{{ $member->research_gate_url }}" target="_blank" class="w-8 h-8 rounded-full bg-primary-light/10 border border-glass-border/30 flex items-center justify-center text-text-secondary hover:text-secondary hover:border-secondary/50 transition-colors" title="ResearchGate">
                                            <i class="fab fa-researchgate text-xs"></i>
                                        </a>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

            <!-- Staff Members Group -->
            @if($staffs->count() > 0)
                <div class="mb-20">
                    <div class="text-center mb-12 animate-on-scroll">
                        <span class="text-primary-muted font-bold text-xs uppercase tracking-widest block mb-2">Operations & Research</span>
                        <h2 class="text-3xl font-heading font-bold text-text-primary">Administrative & Field Staffs</h2>
                        <div class="section-divider mx-auto"></div>
                    </div>
                    
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-2 max-w-4xl mx-auto gap-8">
                        @foreach($staffs as $member)
                            @php
                                $cleanName = preg_replace('/^(Mr\.|Ms\.|Dr\.|Prof\.|Mrs\.)\s+/i', '', $member->name);
                                $initial = strtoupper(substr($cleanName, 0, 1));
                            @endphp
                            <div class="team-card flex flex-col items-center animate-on-scroll">
                                @if($member->photo)
                                    <img src="{{ $member->photo }}" alt="{{ $member->name }}" loading="lazy" class="w-24 h-24 rounded-full object-cover mb-4 border-2 border-secondary/20 shadow-lg">
                                @else
                                    <div class="w-24 h-24 rounded-full bg-gradient-to-tr from-primary-light to-primary-accent flex items-center justify-center text-text-primary text-3xl font-bold font-heading mb-4 border-2 border-secondary/20 shadow-lg">
                                        {{ $initial }}
                                    </div>
                                @endif
                                <h3 class="text-lg font-bold text-text-primary mb-1">{{ $member->name }}</h3>
                                <p class="text-secondary text-sm font-medium">{{ $member->designation }}</p>
                                <div class="flex items-center gap-3 mt-4">
                                    @if($member->email)
                                        <a href="mailto:{{ $member->email }}" class="w-8 h-8 rounded-full bg-primary-light/10 border border-glass-border/30 flex items-center justify-center text-text-secondary hover:text-secondary hover:border-secondary/50 transition-colors" title="Email">
                                            <i class="fas fa-envelope text-xs"></i>
                                        </a>
                                    @endif
                                    @if($member->phone)
                                        <a href="tel:{{ $member->phone }}" class="w-8 h-8 rounded-full bg-primary-light/10 border border-glass-border/30 flex items-center justify-center text-text-secondary hover:text-secondary hover:border-secondary/50 transition-colors" title="Phone">
                                            <i class="fas fa-phone-alt text-xs"></i>
                                        </a>
                                    @endif
                                    @if($member->google_scholar_url)
                                        <a href="{{ $member->google_scholar_url }}" target="_blank" class="w-8 h-8 rounded-full bg-primary-light/10 border border-glass-border/30 flex items-center justify-center text-text-secondary hover:text-secondary hover:border-secondary/50 transition-colors" title="Google Scholar">
                                            <i class="fas fa-graduation-cap text-xs"></i>
                                        </a>
                                    @endif
                                    @if($member->research_gate_url)
                                        <a href="{{ $member->research_gate_url }}" target="_blank" class="w-8 h-8 rounded-full bg-primary-light/10 border border-glass-border/30 flex items-center justify-center text-text-secondary hover:text-secondary hover:border-secondary/50 transition-colors" title="ResearchGate">
                                            <i class="fab fa-researchgate text-xs"></i>
                                        </a>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

            <!-- Volunteers Group -->
            @if($volunteers->count() > 0)
                <div>
                    <div class="text-center mb-12 animate-on-scroll">
                        <span class="text-primary-muted font-bold text-xs uppercase tracking-widest block mb-2">Our Global Helpers</span>
                        <h2 class="text-3xl font-heading font-bold text-text-primary">Volunteers</h2>
                        <div class="section-divider mx-auto"></div>
                    </div>
                    
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-2 max-w-4xl mx-auto gap-8">
                        @foreach($volunteers as $member)
                            @php
                                $cleanName = preg_replace('/^(Mr\.|Ms\.|Dr\.|Prof\.|Mrs\.)\s+/i', '', $member->name);
                                $initial = strtoupper(substr($cleanName, 0, 1));
                            @endphp
                            <div class="team-card flex flex-col items-center animate-on-scroll">
                                @if($member->photo)
                                    <img src="{{ $member->photo }}" alt="{{ $member->name }}" loading="lazy" class="w-24 h-24 rounded-full object-cover mb-4 border-2 border-secondary/20 shadow-lg">
                                @else
                                    <div class="w-24 h-24 rounded-full bg-gradient-to-tr from-primary-light to-primary-accent flex items-center justify-center text-text-primary text-3xl font-bold font-heading mb-4 border-2 border-secondary/20 shadow-lg">
                                        {{ $initial }}
                                    </div>
                                @endif
                                <h3 class="text-lg font-bold text-text-primary mb-1">{{ $member->name }}</h3>
                                <p class="text-secondary text-sm font-medium mb-2">{{ $member->designation }}</p>
                                @if($member->country)
                                    <span class="text-text-muted text-xs"><i class="fas fa-globe-americas mr-1"></i> From: {{ $member->country }}</span>
                                @endif
                                <div class="flex items-center gap-3 mt-4">
                                    @if($member->email)
                                        <a href="mailto:{{ $member->email }}" class="w-8 h-8 rounded-full bg-primary-light/10 border border-glass-border/30 flex items-center justify-center text-text-secondary hover:text-secondary hover:border-secondary/50 transition-colors" title="Email">
                                            <i class="fas fa-envelope text-xs"></i>
                                        </a>
                                    @endif
                                    @if($member->phone)
                                        <a href="tel:{{ $member->phone }}" class="w-8 h-8 rounded-full bg-primary-light/10 border border-glass-border/30 flex items-center justify-center text-text-secondary hover:text-secondary hover:border-secondary/50 transition-colors" title="Phone">
                                            <i class="fas fa-phone-alt text-xs"></i>
                                        </a>
                                    @endif
                                    @if($member->google_scholar_url)
                                        <a href="{{ $member->google_scholar_url }}" target="_blank" class="w-8 h-8 rounded-full bg-primary-light/10 border border-glass-border/30 flex items-center justify-center text-text-secondary hover:text-secondary hover:border-secondary/50 transition-colors" title="Google Scholar">
                                            <i class="fas fa-graduation-cap text-xs"></i>
                                        </a>
                                    @endif
                                    @if($member->research_gate_url)
                                        <a href="{{ $member->research_gate_url }}" target="_blank" class="w-8 h-8 rounded-full bg-primary-light/10 border border-glass-border/30 flex items-center justify-center text-text-secondary hover:text-secondary hover:border-secondary/50 transition-colors" title="ResearchGate">
                                            <i class="fab fa-researchgate text-xs"></i>
                                        </a>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

        </div>
    </section>
@endsection
