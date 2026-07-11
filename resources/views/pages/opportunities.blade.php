@extends('layouts.app')

@section('title', 'Thesis Grants & Volunteering | Natural Science Society (NSS) Nepal')

@section('content')
    <!-- Banner Page Header -->
    <header class="page-header">
        <div class="container mx-auto px-4 md:px-8 relative z-10">
            <span class="text-secondary text-sm font-semibold tracking-widest uppercase mb-2 block">Grow With Us</span>
            <h1 class="text-4xl md:text-5xl font-heading font-extrabold text-white">Opportunities</h1>
            <div class="section-divider mx-auto"></div>
        </div>
    </header>

    <!-- Opportunities segment -->
    <section class="py-20 bg-dark-bg">
        <div class="container mx-auto px-4 md:px-8 max-w-4xl">
            
            <div class="flex flex-col gap-12">
                @forelse($opportunities as $opp)
                    <div class="glass-card p-8 md:p-10 animate-on-scroll relative overflow-hidden flex flex-col gap-6">
                        <!-- Left forest border accent -->
                        <div class="absolute left-0 top-0 bottom-0 w-1.5 bg-gradient-to-b from-primary-light to-primary-accent"></div>
                        
                        <div class="flex items-start md:items-center justify-between gap-4 flex-col md:flex-row">
                            <h2 class="text-2xl font-bold font-heading text-white">
                                {{ $opp->title }}
                            </h2>
                            <span class="badge badge-ongoing shrink-0">
                                {{ str_replace('_', ' ', $opp->type) }}
                            </span>
                        </div>

                        <div class="prose prose-invert max-w-none text-text-secondary leading-relaxed">
                            {!! $opp->content !!}
                        </div>

                        <div class="border-t border-glass-border/30 pt-6 mt-4 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
                            <span class="text-text-muted text-xs"><i class="fas fa-info-circle mr-1"></i> Active Listing</span>
                            <a href="/contact-us?subject={{ urlencode('Application for ' . $opp->title) }}" class="btn-primary py-2 px-5 text-sm bg-gradient-to-r from-primary-light to-primary-accent rounded-lg flex items-center gap-2">
                                <i class="fas fa-paper-plane"></i> Apply Now / Send Inquiry
                            </a>
                        </div>
                    </div>
                @empty
                    <div class="text-center py-16 text-text-secondary glass-card">
                        <i class="fas fa-graduation-cap text-3xl mb-4 text-primary-muted"></i>
                        <p class="text-sm">No active opportunity listings at this moment. Stay tuned!</p>
                    </div>
                @endforelse
            </div>

            <!-- Pagination -->
            @if($opportunities->hasPages())
                <div class="max-w-4xl mx-auto flex justify-center mt-12">
                    <div class="glass p-2 rounded-xl border border-glass-border/30">
                        {{ $opportunities->links() }}
                    </div>
                </div>
            @endif

        </div>
    </section>
@endsection
