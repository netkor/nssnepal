<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Natural Science Society (NSS) Nepal')</title>
    
    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">
    <!-- Meta tags for SEO -->
    <meta name="description" content="@yield('meta_description', 'Natural Science Society (NSS) Nepal is a non-governmental organization focused on research and conservation of biodiversity, environmental education, and awareness programs.')">
    <meta name="keywords" content="NSS Nepal, Natural Science Society, biodiversity conservation, environmental education, research, Nepal, wildlife conservation, hyena, musk deer, tiger">
    <meta name="author" content="NSS Nepal">
    <meta name="robots" content="index, follow">
    
    <!-- Open Graph & Twitter Cards -->
    <meta property="og:type" content="@yield('og_type', 'website')">
    <meta property="og:title" content="@yield('og_title', View::getSection('title', 'Natural Science Society (NSS) Nepal'))">
    <meta property="og:description" content="@yield('og_description', View::getSection('meta_description', 'Natural Science Society (NSS) Nepal is a non-governmental organization focused on research and conservation.'))">
    <meta property="og:image" content="@yield('og_image', asset('images/logo.png'))">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Outfit:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- FontAwesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Custom CSS -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @if(isset($siteSettings['theme_primary']) || isset($siteSettings['theme_secondary']) || isset($siteSettings['theme_bg']))
        <style>
            :root {
                @if(!empty($siteSettings['theme_primary']))
                    --color-primary: {{ $siteSettings['theme_primary'] }};
                    --color-primary-light: color-mix(in srgb, {{ $siteSettings['theme_primary'] }} 90%, transparent);
                    --color-primary-accent: color-mix(in srgb, {{ $siteSettings['theme_primary'] }} 85%, transparent);
                    --color-primary-muted: color-mix(in srgb, {{ $siteSettings['theme_primary'] }} 75%, transparent);
                @endif
                @if(!empty($siteSettings['theme_secondary']))
                    --color-secondary: {{ $siteSettings['theme_secondary'] }};
                    --color-secondary-light: color-mix(in srgb, {{ $siteSettings['theme_secondary'] }} 90%, transparent);
                    --color-secondary-pale: color-mix(in srgb, {{ $siteSettings['theme_secondary'] }} 75%, transparent);
                @endif
                @if(!empty($siteSettings['theme_bg']))
                    --color-dark-bg: {{ $siteSettings['theme_bg'] }};
                @endif
                @if(!empty($siteSettings['theme_surface']))
                    --color-dark-surface: {{ $siteSettings['theme_surface'] }};
                    --color-dark-surface-light: color-mix(in srgb, {{ $siteSettings['theme_surface'] }} 90%, white);
                    --color-dark-surface-elevated: color-mix(in srgb, {{ $siteSettings['theme_surface'] }} 80%, white);
                    --color-glass: color-mix(in srgb, {{ $siteSettings['theme_surface'] }} 60%, transparent);
                    --color-glass-light: color-mix(in srgb, {{ $siteSettings['theme_surface'] }} 30%, transparent);
                    --color-glass-border: color-mix(in srgb, {{ $siteSettings['theme_primary'] ?? '#0e1f34' }} 25%, transparent);
                @endif
                @if(!empty($siteSettings['theme_text']))
                    --color-text-primary: {{ $siteSettings['theme_text'] }};
                    --color-text-secondary: color-mix(in srgb, {{ $siteSettings['theme_text'] }} 80%, transparent);
                    --color-text-muted: color-mix(in srgb, {{ $siteSettings['theme_text'] }} 65%, transparent);
                @endif
            }
        </style>
    @endif
</head>
<body class="bg-dark-bg text-text-primary min-h-screen flex flex-col selection:bg-primary-accent selection:text-text-primary">
    
    <!-- Fixed Navbar -->
    <nav class="navbar w-full" id="mainNavbar">
        <div class="container mx-auto px-4 md:px-8 flex justify-between items-center">
            <!-- Logo / Brand -->
            <a href="/" class="flex items-center gap-3">
                <img src="/images/logo.png" alt="NSS Logo" class="h-10 w-10 rounded-full border border-secondary/30 object-cover">
                <div class="flex flex-col">
                    <span class="text-lg font-bold font-heading tracking-wide uppercase text-text-primary leading-none">Natural Science Society</span>
                </div>
            </a>

            <!-- Navigation Links (Desktop) -->
            <div class="hidden lg:flex items-center gap-2">
                <a href="/" class="nav-link {{ Request::is('/') ? 'active' : '' }}">Home</a>
                <a href="/about-us" class="nav-link {{ Request::is('about-us') ? 'active' : '' }}">About Us</a>
                <a href="/teams" class="nav-link {{ Request::is('teams') ? 'active' : '' }}">Team</a>
                
                <div class="relative nav-item py-2">
                    <button class="nav-link flex items-center gap-1 focus:outline-none">
                        Projects <i class="fas fa-chevron-down text-[10px]"></i>
                    </button>
                    <div class="nav-dropdown">
                        <a href="/projects">All Projects</a>
                        <a href="/projects?status=ongoing">Ongoing Projects</a>
                        <a href="/projects?status=completed">Completed Projects</a>
                    </div>
                </div>

                <a href="/gallery" class="nav-link {{ Request::is('gallery*') ? 'active' : '' }}">Gallery</a>
                <a href="/news-and-events" class="nav-link {{ Request::is('news-and-events*') ? 'active' : '' }}">News & Events</a>
                
                <div class="relative nav-item py-2">
                    <button class="nav-link flex items-center gap-1 focus:outline-none">
                        Downloads <i class="fas fa-chevron-down text-[10px]"></i>
                    </button>
                    <div class="nav-dropdown">
                        <a href="/downloads/publications">Publications</a>
                        <a href="/downloads/reports">Reports & Materials</a>
                    </div>
                </div>

                <a href="/opportunities" class="nav-link {{ Request::is('opportunities*') ? 'active' : '' }}">Opportunities</a>
                <a href="/contact-us" class="nav-link {{ Request::is('contact-us') ? 'active' : '' }}">Contact Us</a>
                
                <a href="/support-us" class="btn-primary py-2 px-5 ml-4 text-sm bg-gradient-to-r from-primary-light to-primary-accent rounded-lg flex items-center gap-2 shadow-lg shadow-primary-light/20 hover:scale-105 transition-all duration-300">
                    <i class="fas fa-heart text-secondary"></i> Support Us
                </a>
            </div>

            <!-- Hamburger Button (Mobile) -->
            <button class="lg:hidden text-text-primary focus:outline-none" id="hamburgerBtn" aria-label="Toggle Navigation">
                <i class="fas fa-bars text-2xl"></i>
            </button>
        </div>
    </nav>

    <!-- Mobile Slide-over Menu -->
    <div class="mobile-menu" id="mobileMenu">
        <div class="p-6 flex flex-col h-full">
            <div class="flex justify-between items-center mb-8">
                <div class="flex items-center gap-3">
                    <img src="/images/logo.png" alt="NSS Logo" class="h-10 w-10 rounded-full border border-secondary/30 object-cover">
                    <span class="text-xl font-bold font-heading uppercase text-text-primary">NSS Nepal</span>
                </div>
                <button class="text-text-primary text-2xl focus:outline-none" id="closeMenuBtn" aria-label="Close Navigation">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            
            <div class="flex flex-col gap-4 text-lg overflow-y-auto flex-grow pb-8">
                <a href="/" class="nav-link py-2 {{ Request::is('/') ? 'text-secondary font-semibold' : '' }}">Home</a>
                <a href="/about-us" class="nav-link py-2 {{ Request::is('about-us') ? 'text-secondary font-semibold' : '' }}">About Us</a>
                <a href="/teams" class="nav-link py-2 {{ Request::is('teams') ? 'text-secondary font-semibold' : '' }}">Team</a>
                
                <div class="border-b border-glass-border/30 pb-2">
                    <span class="text-text-muted text-xs font-semibold uppercase tracking-wider block mb-2">Projects</span>
                    <a href="/projects" class="nav-link block pl-4 py-1.5 {{ Request::is('projects') ? 'text-secondary font-semibold' : '' }}">All Projects</a>
                    <a href="/projects?status=ongoing" class="nav-link block pl-4 py-1.5">Ongoing</a>
                    <a href="/projects?status=completed" class="nav-link block pl-4 py-1.5">Completed</a>
                </div>

                <a href="/gallery" class="nav-link py-2 {{ Request::is('gallery*') ? 'text-secondary font-semibold' : '' }}">Gallery</a>
                <a href="/news-and-events" class="nav-link py-2 {{ Request::is('news-and-events*') ? 'text-secondary font-semibold' : '' }}">News & Events</a>
                
                <div class="border-b border-glass-border/30 pb-2">
                    <span class="text-text-muted text-xs font-semibold uppercase tracking-wider block mb-2">Downloads</span>
                    <a href="/downloads/publications" class="nav-link block pl-4 py-1.5">Publications</a>
                    <a href="/downloads/reports" class="nav-link block pl-4 py-1.5">Reports</a>
                </div>

                <a href="/opportunities" class="nav-link py-2 {{ Request::is('opportunities*') ? 'text-secondary font-semibold' : '' }}">Opportunities</a>
                <a href="/contact-us" class="nav-link py-2 {{ Request::is('contact-us') ? 'text-secondary font-semibold' : '' }}">Contact Us</a>
            </div>

            <div class="mt-auto">
                <a href="/support-us" class="btn-primary w-full text-center justify-center py-3 bg-gradient-to-r from-primary-light to-primary-accent rounded-lg flex items-center gap-2">
                    <i class="fas fa-heart text-secondary"></i> Support Us / Donate
                </a>
            </div>
        </div>
    </div>

    <!-- Main Content Area -->
    <main class="flex-grow pt-[4rem]">
        @if(session('success'))
            <div class="container mx-auto px-4 md:px-8 mt-6">
                <div class="bg-primary/20 border border-primary-accent/40 text-secondary p-4 rounded-lg flex items-center gap-3 animate-on-scroll">
                    <i class="fas fa-check-circle"></i>
                    <span>{{ session('success') }}</span>
                </div>
            </div>
        @endif

        @if(session('error'))
            <div class="container mx-auto px-4 md:px-8 mt-6">
                <div class="bg-accent-coral/20 border border-accent-coral/40 text-text-primary p-4 rounded-lg flex items-center gap-3 animate-on-scroll">
                    <i class="fas fa-exclamation-circle text-accent-coral"></i>
                    <span>{{ session('error') }}</span>
                </div>
            </div>
        @endif

        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="footer">
        <div class="container mx-auto px-4 md:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 mb-12">
                <!-- Info Column -->
                <div class="flex flex-col gap-4">
                    <div class="flex items-center gap-3">
                        <img src="/images/logo.png" alt="NSS Logo" class="h-10 w-10 rounded-full border border-secondary/30 object-cover">
                        <div class="flex flex-col">
                            <span class="text-lg font-bold font-heading uppercase text-text-primary leading-none">NSS Nepal</span>
                            <span class="text-[8px] text-text-secondary tracking-wider uppercase">Natural Science Society</span>
                        </div>
                    </div>
                    <p class="text-text-secondary text-sm">
                        Dedicated to the research and conservation of Nepal's rich biodiversity, promoting environmental education, and empowering local communities.
                    </p>
                    <div class="flex flex-wrap gap-2.5 mt-2">
                        @if(!empty($siteSettings['facebook_url']))
                            <a href="{{ $siteSettings['facebook_url'] }}" target="_blank" class="w-8 h-8 rounded-full bg-dark-surface-elevated hover:bg-primary-accent hover:text-text-primary flex items-center justify-center transition-all duration-300" title="Facebook">
                                <i class="fab fa-facebook-f text-sm"></i>
                            </a>
                        @endif
                        @if(!empty($siteSettings['twitter_url']))
                            <a href="{{ $siteSettings['twitter_url'] }}" target="_blank" class="w-8 h-8 rounded-full bg-dark-surface-elevated hover:bg-primary-accent hover:text-text-primary flex items-center justify-center transition-all duration-300" title="Twitter / X">
                                <i class="fab fa-x-twitter text-sm"></i>
                            </a>
                        @endif
                        @if(!empty($siteSettings['instagram_url']))
                            <a href="{{ $siteSettings['instagram_url'] }}" target="_blank" class="w-8 h-8 rounded-full bg-dark-surface-elevated hover:bg-primary-accent hover:text-text-primary flex items-center justify-center transition-all duration-300" title="Instagram">
                                <i class="fab fa-instagram text-sm"></i>
                            </a>
                        @endif
                        @if(!empty($siteSettings['linkedin_url']))
                            <a href="{{ $siteSettings['linkedin_url'] }}" target="_blank" class="w-8 h-8 rounded-full bg-dark-surface-elevated hover:bg-primary-accent hover:text-text-primary flex items-center justify-center transition-all duration-300" title="LinkedIn">
                                <i class="fab fa-linkedin-in text-sm"></i>
                            </a>
                        @endif
                        @if(!empty($siteSettings['youtube_url']))
                            <a href="{{ $siteSettings['youtube_url'] }}" target="_blank" class="w-8 h-8 rounded-full bg-dark-surface-elevated hover:bg-primary-accent hover:text-text-primary flex items-center justify-center transition-all duration-300" title="YouTube">
                                <i class="fab fa-youtube text-sm"></i>
                            </a>
                        @endif
                        @if(!empty($siteSettings['researchgate_url']))
                            <a href="{{ $siteSettings['researchgate_url'] }}" target="_blank" class="w-8 h-8 rounded-full bg-dark-surface-elevated hover:bg-primary-accent hover:text-text-primary flex items-center justify-center transition-all duration-300" title="ResearchGate">
                                <i class="fab fa-researchgate text-sm"></i>
                            </a>
                        @endif
                    </div>
                </div>

                <!-- Quick Links Column -->
                <div class="flex flex-col gap-4">
                    <h4 class="text-text-primary text-md font-heading font-semibold uppercase tracking-wider">Quick Links</h4>
                    <div class="flex flex-col gap-2.5 text-sm">
                        <a href="/about-us" class="hover:translate-x-1 transition-all"><i class="fas fa-angle-right text-xs mr-2 text-primary-accent"></i> About Us</a>
                        <a href="/teams" class="hover:translate-x-1 transition-all"><i class="fas fa-angle-right text-xs mr-2 text-primary-accent"></i> Executive Board & Members</a>
                        <a href="/projects" class="hover:translate-x-1 transition-all"><i class="fas fa-angle-right text-xs mr-2 text-primary-accent"></i> Research Projects</a>
                        <a href="/news-and-events" class="hover:translate-x-1 transition-all"><i class="fas fa-angle-right text-xs mr-2 text-primary-accent"></i> News & Announcements</a>
                        <a href="/gallery" class="hover:translate-x-1 transition-all"><i class="fas fa-angle-right text-xs mr-2 text-primary-accent"></i> Multimedia Gallery</a>
                    </div>
                </div>

                <!-- Support & Partners Column -->
                <div class="flex flex-col gap-4">
                    <h4 class="text-text-primary text-md font-heading font-semibold uppercase tracking-wider">Downloads & Resources</h4>
                    <div class="flex flex-col gap-2.5 text-sm">
                        <a href="/downloads/publications" class="hover:translate-x-1 transition-all"><i class="fas fa-angle-right text-xs mr-2 text-primary-accent"></i> Scientific Publications</a>
                        <a href="/downloads/reports" class="hover:translate-x-1 transition-all"><i class="fas fa-angle-right text-xs mr-2 text-primary-accent"></i> Annual Reports</a>
                        <a href="/opportunities" class="hover:translate-x-1 transition-all"><i class="fas fa-angle-right text-xs mr-2 text-primary-accent"></i> Internships & Research Grants</a>
                        <a href="/support-us" class="hover:translate-x-1 transition-all"><i class="fas fa-angle-right text-xs mr-2 text-primary-accent"></i> Membership Application</a>
                    </div>
                </div>

                <!-- Contact Info Column -->
                <div class="flex flex-col gap-4">
                    <h4 class="text-text-primary text-md font-heading font-semibold uppercase tracking-wider">Contact Info</h4>
                    <div class="flex flex-col gap-3 text-sm text-text-secondary">
                        <div class="flex items-start gap-3">
                            <i class="fas fa-map-marker-alt text-primary-muted mt-1"></i>
                            <span>{{ $siteSettings['contact_address'] ?? 'Kirtipur 5, Kathmandu, Nepal' }}</span>
                        </div>
                        <div class="flex items-start gap-3">
                            <i class="fas fa-envelope text-primary-muted mt-1"></i>
                            <span class="flex flex-col">
                                <a href="mailto:{{ $siteSettings['contact_email'] ?? 'info@nssnepal.org.np' }}" class="hover:text-text-primary transition">
                                    {{ $siteSettings['contact_email'] ?? 'info@nssnepal.org.np' }}
                                </a>
                                @if(isset($siteSettings['contact_email_alt']))
                                    <a href="mailto:{{ $siteSettings['contact_email_alt'] }}" class="hover:text-text-primary transition mt-1">
                                        {{ $siteSettings['contact_email_alt'] }}
                                    </a>
                                @endif
                            </span>
                        </div>
                        <div class="flex items-start gap-3">
                            <i class="fas fa-phone text-primary-muted mt-1"></i>
                            <span>
                                <a href="tel:{{ str_replace([' ', '-'], '', $siteSettings['contact_phone'] ?? '+977-9849987348') }}" class="hover:text-text-primary transition">
                                    {{ $siteSettings['contact_phone'] ?? '+977-9849987348' }}
                                </a>
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Copyright info -->
            <div class="border-t border-glass-border/30 pt-6 text-center text-xs text-text-muted">
                <span>&copy; Natural Science Society (NSS) Nepal. All Rights Reserved.</span>
            </div>
        </div>
    </footer>

    <!-- Simple Scroll Reveal script -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Scroll class addition for navbar
            const navbar = document.getElementById('mainNavbar');
            window.addEventListener('scroll', function() {
                if (window.scrollY > 50) {
                    navbar.classList.add('scrolled');
                } else {
                    navbar.classList.remove('scrolled');
                }
            });

            // Mobile menu toggle
            const hamburgerBtn = document.getElementById('hamburgerBtn');
            const closeMenuBtn = document.getElementById('closeMenuBtn');
            const mobileMenu = document.getElementById('mobileMenu');

            if(hamburgerBtn && closeMenuBtn && mobileMenu) {
                hamburgerBtn.addEventListener('click', () => mobileMenu.classList.add('active'));
                closeMenuBtn.addEventListener('click', () => mobileMenu.classList.remove('active'));
                
                // Close menu if a link is clicked
                const links = mobileMenu.querySelectorAll('a');
                links.forEach(link => {
                    link.addEventListener('click', () => mobileMenu.classList.remove('active'));
                });
            }

            // IntersectionObserver for elements
            const animates = document.querySelectorAll('.animate-on-scroll');
            if ('IntersectionObserver' in window && animates.length > 0) {
                const observer = new IntersectionObserver((entries) => {
                    entries.forEach(entry => {
                        if (entry.isIntersecting) {
                            entry.target.classList.add('visible');
                            observer.unobserve(entry.target);
                        }
                    });
                }, { threshold: 0.1 });

                animates.forEach(el => observer.observe(el));
            } else {
                animates.forEach(el => el.classList.add('visible'));
            }
        });
    </script>
    @yield('scripts')
</body>
</html>
