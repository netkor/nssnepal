<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Login | NSS Nepal</title>
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Outfit:wght@600;700&display=swap" rel="stylesheet">
    
    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-dark-bg min-h-screen flex items-center justify-center p-4">

    <div class="w-full max-w-md">
        <!-- Logo / Header -->
        <div class="text-center mb-8">
            <a href="/" class="inline-flex items-center gap-3 mb-3">
                <img src="/images/logo.png" alt="NSS Logo" class="h-12 w-12 rounded-full border border-secondary/30 object-cover">
                <div class="flex flex-col text-left">
                    <span class="text-xl font-bold font-heading tracking-wide uppercase text-text-primary leading-none">NSS Nepal</span>
                    <span class="text-[9px] text-text-secondary tracking-widest uppercase">Admin Portal</span>
                </div>
            </a>
            <p class="text-text-secondary text-sm">Please sign in to access control settings.</p>
        </div>

        <!-- Glass card form box -->
        <div class="glass-card p-8 shadow-2xl relative overflow-hidden">
            <!-- Top design line -->
            <div class="absolute left-0 right-0 top-0 h-1 bg-gradient-to-r from-primary-light via-primary-accent to-secondary"></div>

            @if($errors->any())
                <div class="bg-accent-coral/20 border border-accent-coral/40 text-text-primary p-4 rounded-lg mb-6">
                    <div class="flex items-center gap-2 mb-2 font-semibold text-accent-coral text-sm">
                        <i class="fas fa-exclamation-triangle"></i>
                        <span>Login Failed:</span>
                    </div>
                    <ul class="list-disc pl-5 text-xs text-text-secondary flex flex-col gap-0.5">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('admin.login.submit') }}">
                @csrf
                <div class="mb-6">
                    <label for="email" class="form-label">Email Address</label>
                    <div class="relative">
                        <span class="absolute left-4 top-1/2 -translate-y-1/2 text-text-muted"><i class="fas fa-envelope"></i></span>
                        <input type="email" id="email" name="email" class="form-input pl-11" placeholder="email" value="{{ old('email') }}" required autofocus>
                    </div>
                </div>

                <div class="mb-6">
                    <label for="password" class="form-label">Password</label>
                    <div class="relative">
                        <span class="absolute left-4 top-1/2 -translate-y-1/2 text-text-muted"><i class="fas fa-lock"></i></span>
                        <input type="password" id="password" name="password" class="form-input pl-11" placeholder="••••••••" required>
                    </div>
                </div>

                <div class="flex items-center justify-between mb-6">
                    <label class="inline-flex items-center text-xs text-text-secondary cursor-pointer">
                        <input type="checkbox" name="remember" class="rounded border-glass-border bg-dark-surface text-primary-accent focus:ring-primary-accent mr-2">
                        Keep me logged in
                    </label>
                </div>

                <button type="submit" class="btn-primary w-full text-center justify-center py-3 bg-gradient-to-r from-primary-light to-primary-accent rounded-lg flex items-center gap-2">
                    Access Portal <i class="fas fa-sign-in-alt text-xs"></i>
                </button>
            </form>
        </div>

        <div class="text-center mt-6">
            <a href="/" class="text-text-muted hover:text-text-primary text-xs transition duration-300">
                <i class="fas fa-arrow-left text-[10px] mr-1"></i> Back to Public Website
            </a>
        </div>
    </div>

</body>
</html>
