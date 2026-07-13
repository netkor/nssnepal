@extends('layouts.app')

@section('title', $album->title . ' | Gallery | NSS Nepal')

@section('content')
    <!-- Banner Page Header -->
    <header class="page-header">
        <div class="container mx-auto px-4 md:px-8 relative z-10 text-left max-w-5xl">
            <a href="/gallery" class="text-secondary hover:text-text-primary text-sm font-semibold flex items-center gap-2 mb-6 transition">
                <i class="fas fa-arrow-left"></i> Back to Albums
            </a>
            <h1 class="text-3xl md:text-5xl font-heading font-extrabold text-text-primary mb-2 leading-tight">
                {{ $album->title }}
            </h1>
            @if($album->description)
                <p class="text-text-secondary max-w-2xl text-md mt-4 leading-relaxed">
                    {{ $album->description }}
                </p>
            @endif
            <div class="section-divider mt-6"></div>
        </div>
    </header>

    <!-- Album Images Grid -->
    <section class="py-20 bg-dark-bg">
        <div class="container mx-auto px-4 md:px-8 max-w-5xl">
            
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                @forelse($images as $index => $image)
                    <div class="relative overflow-hidden rounded-xl aspect-square border border-glass-border/30 bg-primary-light/5 group cursor-pointer" onclick="openLightbox({{ $index }})">
                        <img src="{{ $image->image_path }}" alt="{{ $image->caption ?? 'Gallery Image' }}" loading="lazy" class="w-full h-full object-cover group-hover:scale-110 transition duration-500">
                        <div class="absolute inset-0 bg-black/60 opacity-0 group-hover:opacity-100 transition duration-300 flex flex-col justify-end p-4">
                            @if($image->caption)
                                <p class="text-text-primary text-xs font-medium leading-normal mb-1">{{ $image->caption }}</p>
                            @endif
                            <span class="text-secondary text-[10px]"><i class="fas fa-search-plus"></i> Zoom Image</span>
                        </div>
                    </div>
                @empty
                    <div class="col-span-4 text-center py-16 text-text-secondary glass-card">
                        <i class="fas fa-image text-3xl mb-4 text-primary-muted"></i>
                        <p class="text-sm">No images in this album yet.</p>
                    </div>
                @endforelse
            </div>

        </div>
    </section>

    <!-- Lightbox Overlay with Navigation -->
    <div class="lightbox-overlay" id="lightboxOverlay" onclick="closeLightbox()">
        <!-- Close Button -->
        <button class="lightbox-close" onclick="closeLightbox()" aria-label="Close">
            <i class="fas fa-times"></i>
        </button>

        <!-- Image Counter -->
        <div class="lightbox-counter" id="lightboxCounter"></div>

        <!-- Previous Button -->
        <button class="lightbox-nav lightbox-prev" id="lightboxPrev" onclick="event.stopPropagation(); navigateLightbox(-1)" aria-label="Previous image">
            <i class="fas fa-chevron-left"></i>
        </button>

        <!-- Next Button -->
        <button class="lightbox-nav lightbox-next" id="lightboxNext" onclick="event.stopPropagation(); navigateLightbox(1)" aria-label="Next image">
            <i class="fas fa-chevron-right"></i>
        </button>

        <!-- Image Container -->
        <div class="lightbox-content" onclick="event.stopPropagation()">
            <img src="" alt="" id="lightboxImg" class="lightbox-image">
            <p id="lightboxCaption" class="lightbox-caption"></p>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        // Build image gallery array from Blade data
        const galleryImages = @json($images->map(fn($img) => ['src' => $img->image_path, 'caption' => $img->caption ?? ''])->values());

        let currentIndex = 0;

        const overlay = document.getElementById('lightboxOverlay');
        const img = document.getElementById('lightboxImg');
        const caption = document.getElementById('lightboxCaption');
        const counter = document.getElementById('lightboxCounter');
        const prevBtn = document.getElementById('lightboxPrev');
        const nextBtn = document.getElementById('lightboxNext');

        function showImage(index) {
            if (!galleryImages.length) return;
            currentIndex = index;

            // Fade out, swap, fade in
            img.style.opacity = '0';
            setTimeout(() => {
                img.src = galleryImages[index].src;
                caption.textContent = galleryImages[index].caption;
                counter.textContent = (index + 1) + ' / ' + galleryImages.length;
                img.style.opacity = '1';
            }, 150);

            // Hide/show nav buttons at boundaries
            prevBtn.style.display = index === 0 ? 'none' : '';
            nextBtn.style.display = index === galleryImages.length - 1 ? 'none' : '';
        }

        function openLightbox(index) {
            if (overlay) {
                showImage(index);
                overlay.classList.add('active');
                document.body.style.overflow = 'hidden';
            }
        }

        function closeLightbox() {
            if (overlay) {
                overlay.classList.remove('active');
                document.body.style.overflow = '';
            }
        }

        function navigateLightbox(direction) {
            const newIndex = currentIndex + direction;
            if (newIndex >= 0 && newIndex < galleryImages.length) {
                showImage(newIndex);
            }
        }

        // Keyboard navigation
        document.addEventListener('keydown', (e) => {
            if (!overlay.classList.contains('active')) return;
            if (e.key === 'Escape') closeLightbox();
            if (e.key === 'ArrowLeft') navigateLightbox(-1);
            if (e.key === 'ArrowRight') navigateLightbox(1);
        });

        // Touch/swipe support for mobile
        let touchStartX = 0;
        let touchEndX = 0;

        overlay.addEventListener('touchstart', (e) => {
            touchStartX = e.changedTouches[0].screenX;
        }, { passive: true });

        overlay.addEventListener('touchend', (e) => {
            touchEndX = e.changedTouches[0].screenX;
            const diff = touchStartX - touchEndX;
            if (Math.abs(diff) > 50) { // minimum swipe distance
                navigateLightbox(diff > 0 ? 1 : -1);
            }
        }, { passive: true });
    </script>
@endsection
