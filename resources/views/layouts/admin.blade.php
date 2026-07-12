<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Admin Panel') | NSS Nepal</title>
    
    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">
    
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Outfit:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- TinyMCE Rich Text Editor (Community Free Version via cdnjs) -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/6.8.2/tinymce.min.js" referrerpolicy="origin"></script>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @if(isset($siteSettings['theme_primary']) || isset($siteSettings['theme_secondary']) || isset($siteSettings['theme_bg']))
        <style>
            :root {
                @if(!empty($siteSettings['theme_primary']))
                    --color-primary: {{ $siteSettings['theme_primary'] }};
                    --color-primary-light: color-mix(in srgb, {{ $siteSettings['theme_primary'] }} 80%, white);
                    --color-primary-accent: color-mix(in srgb, {{ $siteSettings['theme_primary'] }} 60%, white);
                    --color-primary-muted: color-mix(in srgb, {{ $siteSettings['theme_primary'] }} 40%, white);
                @endif
                @if(!empty($siteSettings['theme_secondary']))
                    --color-secondary: {{ $siteSettings['theme_secondary'] }};
                    --color-secondary-light: color-mix(in srgb, {{ $siteSettings['theme_secondary'] }} 80%, white);
                    --color-secondary-pale: color-mix(in srgb, {{ $siteSettings['theme_secondary'] }} 40%, white);
                @endif
                @if(!empty($siteSettings['theme_bg']))
                    --color-dark-bg: {{ $siteSettings['theme_bg'] }};
                @endif
                @if(!empty($siteSettings['theme_surface']))
                    --color-dark-surface: {{ $siteSettings['theme_surface'] }};
                    --color-dark-surface-light: color-mix(in srgb, {{ $siteSettings['theme_surface'] }} 90%, white);
                    --color-dark-surface-elevated: color-mix(in srgb, {{ $siteSettings['theme_surface'] }} 80%, white);
                @endif
                @if(!empty($siteSettings['theme_text']))
                    --color-text-primary: {{ $siteSettings['theme_text'] }};
                    --color-text-secondary: color-mix(in srgb, {{ $siteSettings['theme_text'] }} 70%, transparent);
                    --color-text-muted: color-mix(in srgb, {{ $siteSettings['theme_text'] }} 50%, transparent);
                @endif
            }
        </style>
    @endif
</head>
<body class="bg-dark-bg text-text-primary min-h-screen flex selection:bg-primary-accent selection:text-white">

    <!-- Sidebar -->
    <aside class="admin-sidebar shrink-0 hidden md:flex flex-col">
        <div class="px-6 pb-6 border-b border-glass-border/30 mb-4">
            <a href="/" class="flex items-center gap-3 p-0 hover:bg-transparent hover:border-0">
                <img src="/images/logo.png" alt="NSS Logo" class="h-9 w-9 rounded-full object-cover border border-secondary/30">
                <div class="flex flex-col">
                    <span class="text-sm font-bold uppercase text-white leading-none">NSS Admin</span>
                    <span class="text-[9px] text-text-secondary tracking-widest">PUBLIC SITE</span>
                </div>
            </a>
        </div>

        <nav class="flex-grow overflow-y-auto">
            <a href="/admin/dashboard" class="{{ Request::is('admin/dashboard') ? 'active' : '' }}">
                <i class="fas fa-chart-line w-5"></i> Dashboard
            </a>
            <a href="/admin/sliders" class="{{ Request::is('admin/sliders*') ? 'active' : '' }}">
                <i class="fas fa-images w-5"></i> Hero Sliders
            </a>
            <a href="/admin/team-members" class="{{ Request::is('admin/team-members*') ? 'active' : '' }}">
                <i class="fas fa-users w-5"></i> Team Members
            </a>
            <a href="/admin/projects" class="{{ Request::is('admin/projects*') ? 'active' : '' }}">
                <i class="fas fa-briefcase w-5"></i> Projects
            </a>
            <a href="/admin/gallery-albums" class="{{ Request::is('admin/gallery-albums*') ? 'active' : '' }}">
                <i class="fas fa-photo-film w-5"></i> Gallery Albums
            </a>
            <a href="/admin/news-events" class="{{ Request::is('admin/news-events*') ? 'active' : '' }}">
                <i class="fas fa-bullhorn w-5"></i> News & Events
            </a>
            <a href="/admin/downloads" class="{{ Request::is('admin/downloads*') ? 'active' : '' }}">
                <i class="fas fa-file-download w-5"></i> Downloads
            </a>
            <a href="/admin/opportunities" class="{{ Request::is('admin/opportunities*') ? 'active' : '' }}">
                <i class="fas fa-graduation-cap w-5"></i> Opportunities
            </a>
            <a href="/admin/partners" class="{{ Request::is('admin/partners*') ? 'active' : '' }}">
                <i class="fas fa-handshake w-5"></i> Partners
            </a>
            <a href="/admin/messages" class="{{ Request::is('admin/messages*') ? 'active' : '' }} justify-between">
                <span class="flex items-center gap-3">
                    <i class="fas fa-envelope w-5"></i> Messages
                </span>
                @php
                    $unreadCount = \App\Models\ContactMessage::unread()->count();
                @endphp
                @if($unreadCount > 0)
                    <span class="bg-accent-coral text-white text-[10px] font-bold px-2 py-0.5 rounded-full">{{ $unreadCount }}</span>
                @endif
            </a>
            <a href="/admin/settings" class="{{ Request::is('admin/settings*') ? 'active' : '' }}">
                <i class="fas fa-cog w-5"></i> Site Settings
            </a>
        </nav>

        <div class="p-4 border-t border-glass-border/30 mt-auto">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="w-full flex items-center gap-3 px-4 py-2 text-text-secondary hover:text-accent-coral text-sm font-semibold rounded-lg hover:bg-glass-light transition-all">
                    <i class="fas fa-sign-out-alt"></i> Log Out
                </button>
            </form>
        </div>
    </aside>

    <!-- Main Content Area -->
    <div class="flex-grow flex flex-col min-w-0">
        <!-- Top Nav -->
        <header class="h-16 border-b border-glass-border/35 flex items-center justify-between px-6 md:px-8">
            <div class="flex items-center gap-4">
                <!-- Hamburger for mobile -->
                <button class="md:hidden text-white text-xl focus:outline-none" id="adminMobileBtn">
                    <i class="fas fa-bars"></i>
                </button>
                <h2 class="text-lg font-bold font-heading text-white">@yield('page_title', 'Dashboard')</h2>
            </div>
            
            <div class="flex items-center gap-4">
                <span class="text-sm text-text-secondary"><i class="fas fa-user-shield mr-1"></i> Admin</span>
            </div>
        </header>

        <!-- Main Body -->
        <main class="flex-grow p-6 md:p-8 overflow-y-auto">
            @if(session('success'))
                <div class="bg-primary/20 border border-primary-accent/40 text-secondary p-4 rounded-lg mb-6 flex items-center gap-3">
                    <i class="fas fa-check-circle"></i>
                    <span>{{ session('success') }}</span>
                </div>
            @endif

            @if(session('error'))
                <div class="bg-accent-coral/20 border border-accent-coral/40 text-accent-coral p-4 rounded-lg mb-6 flex items-center gap-3">
                    <i class="fas fa-exclamation-circle"></i>
                    <span>{{ session('error') }}</span>
                </div>
            @endif

            @if($errors->any())
                <div class="bg-accent-coral/20 border border-accent-coral/40 text-text-primary p-4 rounded-lg mb-6">
                    <div class="flex items-center gap-3 mb-2 font-semibold text-accent-coral">
                        <i class="fas fa-exclamation-triangle"></i>
                        <span>Validation Errors:</span>
                    </div>
                    <ul class="list-disc pl-8 text-sm text-text-secondary gap-1 flex flex-col">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @yield('content')
        </main>
    </div>

    <!-- Mobile sidebar slideover -->
    <div class="mobile-menu" id="adminMobileMenu">
        <div class="p-6 flex flex-col h-full">
            <div class="flex justify-between items-center mb-8">
                <div class="flex items-center gap-3">
                    <img src="/images/logo.png" alt="NSS Logo" class="h-8 w-8 rounded-full border border-secondary/30 object-cover">
                    <span class="text-lg font-bold font-heading uppercase text-white">NSS Admin</span>
                </div>
                <button class="text-white text-2xl focus:outline-none" id="closeAdminMenuBtn">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            
            <div class="flex flex-col gap-4 text-md overflow-y-auto flex-grow pb-8">
                <a href="/admin/dashboard" class="py-2 flex items-center gap-3">
                    <i class="fas fa-chart-line w-5"></i> Dashboard
                </a>
                <a href="/admin/sliders" class="py-2 flex items-center gap-3">
                    <i class="fas fa-images w-5"></i> Sliders
                </a>
                <a href="/admin/team-members" class="py-2 flex items-center gap-3">
                    <i class="fas fa-users w-5"></i> Team Members
                </a>
                <a href="/admin/projects" class="py-2 flex items-center gap-3">
                    <i class="fas fa-briefcase w-5"></i> Projects
                </a>
                <a href="/admin/gallery-albums" class="py-2 flex items-center gap-3">
                    <i class="fas fa-photo-film w-5"></i> Gallery Albums
                </a>
                <a href="/admin/news-events" class="py-2 flex items-center gap-3">
                    <i class="fas fa-bullhorn w-5"></i> News & Events
                </a>
                <a href="/admin/downloads" class="py-2 flex items-center gap-3">
                    <i class="fas fa-file-download w-5"></i> Downloads
                </a>
                <a href="/admin/opportunities" class="py-2 flex items-center gap-3">
                    <i class="fas fa-graduation-cap w-5"></i> Opportunities
                </a>
                <a href="/admin/partners" class="py-2 flex items-center gap-3">
                    <i class="fas fa-handshake w-5"></i> Partners
                </a>
                <a href="/admin/messages" class="py-2 flex items-center justify-between">
                    <span class="flex items-center gap-3">
                        <i class="fas fa-envelope w-5"></i> Messages
                    </span>
                    @if($unreadCount > 0)
                        <span class="bg-accent-coral text-white text-[10px] font-bold px-2 py-0.5 rounded-full">{{ $unreadCount }}</span>
                    @endif
                </a>
                <a href="/admin/settings" class="py-2 flex items-center gap-3">
                    <i class="fas fa-cog w-5"></i> Settings
                </a>
            </div>

            <div class="mt-auto">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="w-full text-center justify-center py-3 bg-accent-coral/20 border border-accent-coral/30 hover:bg-accent-coral text-white rounded-lg flex items-center gap-2">
                        <i class="fas fa-sign-out-alt"></i> Log Out
                    </button>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Mobile Admin Menu
            const adminMobileBtn = document.getElementById('adminMobileBtn');
            const closeAdminMenuBtn = document.getElementById('closeAdminMenuBtn');
            const adminMobileMenu = document.getElementById('adminMobileMenu');

            if(adminMobileBtn && closeAdminMenuBtn && adminMobileMenu) {
                adminMobileBtn.addEventListener('click', () => adminMobileMenu.classList.add('active'));
                closeMenuBtn = closeAdminMenuBtn.addEventListener('click', () => adminMobileMenu.classList.remove('active'));
            }

            // Rich Text editor initialization
            if (typeof tinymce !== 'undefined' && document.querySelector('.rich-editor')) {
                tinymce.init({
                    selector: '.rich-editor',
                    skin: 'oxide-dark',
                    content_css: 'dark',
                    height: 450,
                    menubar: false,
                    plugins: [
                        'advlist', 'autolink', 'lists', 'link', 'image', 'charmap', 'preview',
                        'anchor', 'searchreplace', 'visualblocks', 'code', 'fullscreen',
                        'insertdatetime', 'media', 'table', 'help', 'wordcount'
                    ],
                    toolbar: 'undo redo | blocks | ' +
                        'bold italic forecolor | alignleft aligncenter ' +
                        'alignright alignjustify | bullist numlist outdent indent | ' +
                        'image media link | removeformat | code fullscreen | help',
                    image_title: true,
                    automatic_uploads: true,
                    images_upload_url: '{{ route("admin.upload-image") }}',
                    images_upload_credentials: true,
                    images_upload_handler: function(blobInfo, progress) {
                        return new Promise(function(resolve, reject) {
                            var formData = new FormData();
                            formData.append('file', blobInfo.blob(), blobInfo.filename());
                            formData.append('_token', document.querySelector('meta[name="csrf-token"]').getAttribute('content'));

                            fetch('{{ route("admin.upload-image") }}', {
                                method: 'POST',
                                body: formData,
                                credentials: 'same-origin'
                            })
                            .then(function(resp) { return resp.json(); })
                            .then(function(data) {
                                if (data.location) {
                                    resolve(data.location);
                                } else {
                                    reject({ message: 'Upload failed', remove: true });
                                }
                            })
                            .catch(function() {
                                reject({ message: 'Upload error', remove: true });
                            });
                        });
                    },
                    branding: false,
                    promotion: false
                });
            }
        });
        function previewImg(input, imgId) {
            const preview = document.getElementById(imgId);
            if (!input.files || !input.files[0]) {
                if (preview) {
                    preview.src = '';
                    preview.classList.add('hidden');
                }
                return;
            }

            const file = input.files[0];
            
            // Only process image files (exclude GIFs to keep animations intact)
            if (!file.type.startsWith('image/') || file.type === 'image/gif') {
                const reader = new FileReader();
                reader.onload = function(e) {
                    if (preview) {
                        preview.src = e.target.result;
                        preview.classList.remove('hidden');
                    }
                }
                reader.readAsDataURL(file);
                return;
            }

            const reader = new FileReader();
            reader.onload = function(e) {
                const img = new Image();
                img.onload = function() {
                    const maxW = 2048;
                    const maxH = 2048;
                    let width = img.width;
                    let height = img.height;

                    if (width > maxW || height > maxH) {
                        if (width > height) {
                            height = Math.round((height * maxW) / width);
                            width = maxW;
                        } else {
                            width = Math.round((width * maxH) / height);
                            height = maxH;
                        }
                    }

                    const canvas = document.createElement('canvas');
                    canvas.width = width;
                    canvas.height = height;
                    const ctx = canvas.getContext('2d');
                    ctx.drawImage(img, 0, 0, width, height);

                    canvas.toBlob(function(blob) {
                        if (!blob) return;

                        // Only compress and replace if file > 3MB (since server allows up to 32MB now)
                        if (file.size > 3 * 1024 * 1024) {
                            const newFile = new File([blob], file.name.replace(/\.[^/.]+$/, "") + ".jpg", {
                                type: 'image/jpeg',
                                lastModified: Date.now()
                            });

                            const dataTransfer = new DataTransfer();
                            dataTransfer.items.add(newFile);
                            input.files = dataTransfer.files;
                        }

                        const previewReader = new FileReader();
                        previewReader.onload = function(pe) {
                            if (preview) {
                                preview.src = pe.target.result;
                                preview.classList.remove('hidden');
                            }
                        };
                        previewReader.readAsDataURL(input.files[0]);
                    }, 'image/jpeg', 0.88);
                };
                img.src = e.target.result;
            };
            reader.readAsDataURL(file);
        }
        function previewMultipleImgs(input, containerId) {
            const container = document.getElementById(containerId);
            container.innerHTML = ''; 
            
            if (!input.files || input.files.length === 0) {
                container.classList.add('hidden');
                return;
            }

            container.classList.remove('hidden');
            const filesArr = Array.from(input.files);
            const dt = new DataTransfer();
            let processedCount = 0;

            filesArr.forEach(file => {
                if (!file.type.startsWith('image/') || file.type === 'image/gif') {
                    dt.items.add(file);
                    const imgDiv = document.createElement('div');
                    imgDiv.className = 'w-16 h-16 rounded overflow-hidden border border-glass-border/20 relative bg-primary-light/5';
                    const imgEl = document.createElement('img');
                    imgEl.className = 'w-full h-full object-cover';
                    imgEl.src = URL.createObjectURL(file);
                    imgDiv.appendChild(imgEl);
                    container.appendChild(imgDiv);
                    
                    processedCount++;
                    if (processedCount === filesArr.length) {
                        input.files = dt.files;
                    }
                    return;
                }

                const reader = new FileReader();
                reader.onload = function(e) {
                    const img = new Image();
                    img.onload = function() {
                        const maxW = 2048;
                        const maxH = 2048;
                        let width = img.width;
                        let height = img.height;

                        if (width > maxW || height > maxH) {
                            if (width > height) {
                                height = Math.round((height * maxW) / width);
                                width = maxW;
                            } else {
                                width = Math.round((width * maxH) / height);
                                height = maxH;
                            }
                        }

                        const canvas = document.createElement('canvas');
                        canvas.width = width;
                        canvas.height = height;
                        const ctx = canvas.getContext('2d');
                        ctx.drawImage(img, 0, 0, width, height);

                        canvas.toBlob(function(blob) {
                            if (blob) {
                                // Only compress and replace if file > 3MB
                                if (file.size > 3 * 1024 * 1024) {
                                    const newFile = new File([blob], file.name.replace(/\.[^/.]+$/, "") + ".jpg", {
                                        type: 'image/jpeg',
                                        lastModified: Date.now()
                                    });
                                    dt.items.add(newFile);
                                } else {
                                    dt.items.add(file);
                                }
                                
                                const imgDiv = document.createElement('div');
                                imgDiv.className = 'w-16 h-16 rounded overflow-hidden border border-glass-border/20 relative bg-primary-light/5';
                                const imgEl = document.createElement('img');
                                imgEl.className = 'w-full h-full object-cover';
                                imgEl.src = URL.createObjectURL(blob);
                                imgDiv.appendChild(imgEl);
                                container.appendChild(imgDiv);
                            } else {
                                dt.items.add(file);
                            }

                            processedCount++;
                            if (processedCount === filesArr.length) {
                                input.files = dt.files;
                            }
                        }, 'image/jpeg', 0.88);
                    };
                    img.src = e.target.result;
                };
                reader.readAsDataURL(file);
            });
        }
    </script>
    @yield('scripts')
</body>
</html>
