@extends('layouts.app')

@section('title', 'Gallery | Natural Science Society (NSS) Nepal')

@section('content')
    <!-- Banner Page Header -->
    <header class="page-header">
        <div class="container mx-auto px-4 md:px-8 relative z-10">
            <span class="text-secondary text-sm font-semibold tracking-widest uppercase mb-2 block">Visual Highlights</span>
            <h1 class="text-4xl md:text-5xl font-heading font-extrabold text-white">Our Gallery</h1>
            <div class="section-divider mx-auto"></div>
        </div>
    </header>

    <!-- Gallery Albums Section -->
    <section class="py-20 bg-dark-bg">
        <div class="container mx-auto px-4 md:px-8">
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 max-w-5xl mx-auto">
                @forelse($albums as $album)
                    <div class="glass-card flex flex-col h-full overflow-hidden group animate-on-scroll">
                        <div class="h-56 bg-primary-light/5 overflow-hidden relative">
                            @if($album->display_cover)
                                <img src="{{ $album->display_cover }}" alt="{{ $album->title }}" loading="lazy" class="w-full h-full object-cover group-hover:scale-110 transition duration-500">
                            @else
                                <img src="https://images.unsplash.com/photo-1472396961693-142e6e269027?auto=format&fit=crop&w=800&q=80" alt="{{ $album->title }}" loading="lazy" class="w-full h-full object-cover group-hover:scale-110 transition duration-500">
                            @endif
                            <div class="absolute inset-0 bg-gradient-to-t from-dark-bg via-transparent to-transparent opacity-60"></div>
                            <div class="absolute bottom-4 left-4 right-4">
                                <span class="bg-primary-accent text-white text-[9px] font-bold px-2 py-0.5 rounded uppercase tracking-wider">
                                    {{ $album->images->count() }} Images
                                </span>
                            </div>
                        </div>
                        <div class="p-6 flex flex-col flex-grow">
                            <h3 class="text-xl font-bold font-heading text-white mb-2 group-hover:text-secondary transition">
                                <a href="/gallery/{{ $album->slug }}">{{ $album->title }}</a>
                            </h3>
                            @if($album->description)
                                <p class="text-text-secondary text-sm mb-4 leading-relaxed flex-grow">
                                    {{ Str::limit($album->description, 100) }}
                                </p>
                            @endif
                            <a href="/gallery/{{ $album->slug }}" class="text-secondary group-hover:text-white text-xs font-semibold flex items-center gap-1.5 mt-auto transition">
                                Open Album <i class="fas fa-arrow-right text-[9px]"></i>
                            </a>
                        </div>
                    </div>
                @empty
                    <div class="col-span-3 text-center py-16 text-text-secondary glass-card">
                        <i class="fas fa-images text-4xl mb-4 text-primary-muted"></i>
                        <h3 class="text-lg font-bold text-white mb-2">No Photo Albums Found</h3>
                        <p class="text-sm">Albums can be managed in the administration portal.</p>
                    </div>
                @endforelse
            </div>

            <!-- Pagination -->
            @if($albums->hasPages())
                <div class="max-w-5xl mx-auto flex justify-center mt-12">
                    <div class="glass p-2 rounded-xl border border-glass-border/30">
                        {{ $albums->links() }}
                    </div>
                </div>
            @endif

        </div>
    </section>
@endsection
