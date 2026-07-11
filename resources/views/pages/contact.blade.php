@extends('layouts.app')

@section('title', 'Contact Us | Natural Science Society (NSS) Nepal')

@section('content')
    <!-- Banner Page Header -->
    <header class="page-header">
        <div class="container mx-auto px-4 md:px-8 relative z-10">
            <span class="text-secondary text-sm font-semibold tracking-widest uppercase mb-2 block">Get in Touch</span>
            <h1 class="text-4xl md:text-5xl font-heading font-extrabold text-white">Contact Us</h1>
            <div class="section-divider mx-auto"></div>
        </div>
    </header>

    <!-- Contact section -->
    <section class="py-20 bg-dark-bg">
        <div class="container mx-auto px-4 md:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 max-w-5xl mx-auto items-start">
                
                <!-- Contact info details sidebar -->
                <div class="flex flex-col gap-8 animate-on-scroll">
                    <div>
                        <h2 class="text-2xl font-bold font-heading text-white mb-4">Send Us a Message</h2>
                        @if(!empty($siteSettings['contact_page_intro']))
                            <div class="prose prose-invert max-w-none text-text-secondary leading-relaxed">
                                {!! $siteSettings['contact_page_intro'] !!}
                            </div>
                        @else
                            <p class="text-text-secondary leading-relaxed">
                                Have questions about our research projects? Interested in volunteering, collaborating, or donating? Reach out to us using the contact form, or connect directly through our email addresses.
                            </p>
                        @endif
                    </div>

                    <div class="flex flex-col gap-6">
                        <!-- Info Card 1 -->
                        <div class="glass p-6 rounded-xl border border-glass-border/30 flex items-start gap-4">
                            <div class="w-10 h-10 rounded-lg bg-primary-light/20 flex items-center justify-center text-secondary text-lg shrink-0 mt-1">
                                <i class="fas fa-map-marker-alt"></i>
                            </div>
                            <div>
                                <h4 class="text-white font-semibold text-md mb-1">Our Location</h4>
                                <p class="text-text-secondary text-sm">Kirtipur, Kathmandu, Nepal</p>
                            </div>
                        </div>

                        <!-- Info Card 2 -->
                        <div class="glass p-6 rounded-xl border border-glass-border/30 flex items-start gap-4">
                            <div class="w-10 h-10 rounded-lg bg-primary-light/20 flex items-center justify-center text-secondary text-lg shrink-0 mt-1">
                                <i class="fas fa-envelope"></i>
                            </div>
                            <div>
                                <h4 class="text-white font-semibold text-md mb-1">Email Addresses</h4>
                                <p class="text-text-secondary text-sm mb-1">info@brcsociety.org</p>
                                <p class="text-text-secondary text-sm">shivish.bhandari@yahoo.com</p>
                            </div>
                        </div>

                        <!-- Info Card 3 -->
                        <div class="glass p-6 rounded-xl border border-glass-border/30 flex items-start gap-4">
                            <div class="w-10 h-10 rounded-lg bg-primary-light/20 flex items-center justify-center text-secondary text-lg shrink-0 mt-1">
                                <i class="fas fa-phone"></i>
                            </div>
                            <div>
                                <h4 class="text-white font-semibold text-md mb-1">Phone Number</h4>
                                <p class="text-text-secondary text-sm">+977-1-XXXXXXXX</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Contact form box -->
                <div class="glass-card p-8 animate-on-scroll delay-1 relative">
                    <!-- Status Alerts -->
                    <div id="successAlert" class="bg-primary/20 border border-primary-accent/40 text-secondary p-4 rounded-lg mb-6 flex items-center gap-3 hidden">
                        <i class="fas fa-check-circle"></i>
                        <span id="successMsg"></span>
                    </div>

                    <div id="errorAlert" class="bg-accent-coral/20 border border-accent-coral/40 text-text-primary p-4 rounded-lg mb-6 hidden">
                        <div class="flex items-center gap-2 mb-2 font-semibold text-accent-coral">
                            <i class="fas fa-exclamation-triangle"></i>
                            <span>Error sending message:</span>
                        </div>
                        <ul id="errorList" class="list-disc pl-6 text-sm text-text-secondary flex flex-col gap-1"></ul>
                    </div>

                    <form id="contactForm" onsubmit="submitForm(event)">
                        @csrf
                        <div class="mb-6">
                            <label for="name" class="form-label">Full Name <span class="text-accent-coral">*</span></label>
                            <input type="text" id="name" name="name" class="form-input" placeholder="e.g. Ram Bahadur" required>
                        </div>

                        <div class="mb-6">
                            <label for="email" class="form-label">Email Address <span class="text-accent-coral">*</span></label>
                            <input type="email" id="email" name="email" class="form-input" placeholder="e.g. ram@gmail.com" required>
                        </div>

                        <div class="mb-6">
                            <label for="subject" class="form-label">Subject</label>
                            <input type="text" id="subject" name="subject" class="form-input" placeholder="What is this regarding?">
                        </div>

                        <div class="mb-6">
                            <label for="message" class="form-label">Message <span class="text-accent-coral">*</span></label>
                            <textarea id="message" name="message" class="form-input h-32 resize-none" placeholder="Your message here..." required></textarea>
                        </div>

                        <button type="submit" id="submitBtn" class="btn-primary w-full text-center justify-center py-3 bg-gradient-to-r from-primary-light to-primary-accent rounded-lg flex items-center gap-2">
                            Send Message <i class="fas fa-paper-plane text-xs"></i>
                        </button>
                    </form>
                </div>

            </div>
        </div>
    </section>
@endsection

@section('scripts')
    <script>
        async function submitForm(e) {
            e.preventDefault();

            const form = document.getElementById('contactForm');
            const submitBtn = document.getElementById('submitBtn');
            const successAlert = document.getElementById('successAlert');
            const successMsg = document.getElementById('successMsg');
            const errorAlert = document.getElementById('errorAlert');
            const errorList = document.getElementById('errorList');

            // Reset alerts
            successAlert.classList.add('hidden');
            errorAlert.classList.add('hidden');
            errorList.innerHTML = '';
            
            // Set loading state
            submitBtn.disabled = true;
            submitBtn.innerHTML = 'Sending message <i class="fas fa-spinner fa-spin text-xs"></i>';

            const formData = new FormData(form);

            try {
                const response = await fetch('/contact-us', {
                    method: 'POST',
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest'
                    },
                    body: formData
                });

                const result = await response.json();

                if (response.ok && result.success) {
                    // Success output
                    successMsg.textContent = result.message;
                    successAlert.classList.remove('hidden');
                    form.reset();
                } else {
                    // Validation or model save errors
                    let errors = [];
                    if (result.errors) {
                        errors = Object.values(result.errors).flat();
                    } else if (result.message) {
                        errors = [result.message];
                    } else {
                        errors = ['An unexpected error occurred. Please try again.'];
                    }

                    errors.forEach(err => {
                        const li = document.createElement('li');
                        li.textContent = err;
                        errorList.appendChild(li);
                    });
                    errorAlert.classList.remove('hidden');
                }
            } catch (err) {
                const li = document.createElement('li');
                li.textContent = 'Network or server error occurred. Please check your connection and try again.';
                errorList.appendChild(li);
                errorAlert.classList.remove('hidden');
            } finally {
                submitBtn.disabled = false;
                submitBtn.innerHTML = 'Send Message <i class="fas fa-paper-plane text-xs"></i>';
            }
        }
    </script>
@endsection
