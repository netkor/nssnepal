@extends('layouts.app')

@section('title', 'Support Us | Natural Science Society (NSS) Nepal')

@section('content')
    <!-- Banner Page Header -->
    <header class="page-header">
        <div class="container mx-auto px-4 md:px-8 relative z-10">
            <span class="text-secondary text-sm font-semibold tracking-widest uppercase mb-2 block">Help Us Protect Nature</span>
            <h1 class="text-4xl md:text-5xl font-heading font-extrabold text-white">Support Us</h1>
            <div class="section-divider mx-auto"></div>
        </div>
    </header>

    <!-- Support and Donations content -->
    <section class="py-20 bg-dark-bg">
        <div class="container mx-auto px-4 md:px-8 max-w-5xl">
            
            <!-- Membership Tiers Title -->
            <div class="text-center mb-12 animate-on-scroll">
                <span class="text-primary-muted font-bold text-xs uppercase tracking-widest block mb-2">Join Our Community</span>
                <h2 class="text-3xl font-heading font-bold text-white">Membership Plans</h2>
                <div class="section-divider mx-auto"></div>
                <p class="text-text-secondary text-sm max-w-2xl mx-auto mt-4 leading-relaxed">
                    By becoming a member, you directly fund our local research and school-level environmental campaigns. Choose a tier that fits your background.
                </p>
            </div>

            <!-- Membership Cards Grid -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-24">
                @forelse($memberships as $plan)
                    <div class="pricing-card flex flex-col h-full animate-on-scroll {{ str_contains(strtolower($plan->type), 'general') ? 'featured' : '' }}">
                        @if(str_contains(strtolower($plan->type), 'general'))
                            <div class="absolute -top-3.5 left-1/2 -translate-x-1/2 bg-accent-gold text-dark-bg text-[10px] font-extrabold px-3 py-1 rounded-full uppercase tracking-wider">
                                Most Popular
                            </div>
                        @endif
                        
                        <h3 class="text-xl font-bold font-heading text-white mb-4">{{ $plan->type }}</h3>
                        
                        <div class="mb-6 flex flex-col items-center">
                            <span class="price">Rs. {{ number_format($plan->cost_initial) }}</span>
                            @if($plan->cost_yearly > 0)
                                <span class="text-text-muted text-xs font-semibold mt-1">then Rs. {{ number_format($plan->cost_yearly) }} / year</span>
                            @else
                                <span class="text-text-muted text-xs font-semibold mt-1">One-time payment</span>
                            @endif
                        </div>

                        <p class="text-text-secondary text-sm leading-relaxed flex-grow mb-8">
                            {{ $plan->description }}
                        </p>

                        <button onclick="openMembershipModal('{{ addslashes($plan->type) }}')" class="btn-primary w-full text-center justify-center py-2.5 rounded-lg border border-glass-border">
                            Apply for Membership
                        </button>
                    </div>
                @empty
                    <div class="col-span-3 text-center py-12 text-text-secondary glass-card">
                        No membership tiers configured.
                    </div>
                @endforelse
            </div>

            <!-- Donation & Bank details segment -->
            <div class="border-t border-glass-border/30 pt-20">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                    
                    <div class="animate-on-scroll">
                        <span class="text-accent-gold text-xs font-bold uppercase tracking-widest block mb-2">Direct Contribution</span>
                        <h2 class="text-3xl font-heading font-bold text-white mb-4">Bank Donations</h2>
                        <p class="text-text-secondary text-sm leading-relaxed mb-6">
                            If you wish to make a general donation or fund a specific species project (e.g., striped hyena research or nesting ecology of the lesser adjutant), you can wire funds directly to our bank account.
                        </p>
                        <p class="text-text-secondary text-sm leading-relaxed mb-8">
                            Please contact us or email your receipt to <strong>shivish.bhandari@yahoo.com</strong> after transfer so we can issue an official acknowledgment and project update.
                        </p>
                        <a href="/contact-us" class="btn-secondary flex items-center gap-2 w-max">
                            <i class="fas fa-envelope text-xs"></i> Contact for Wire Support
                        </a>
                    </div>

                    <!-- Bank details display box -->
                    <div class="glass-card p-8 animate-on-scroll delay-1">
                        <h3 class="text-xl font-bold font-heading text-white mb-6 border-b border-glass-border/30 pb-4 flex items-center gap-2">
                            <i class="fas fa-university text-secondary"></i> Bank Details
                        </h3>

                        <div class="flex flex-col gap-4 text-sm text-text-secondary">
                            <div class="flex justify-between border-b border-glass-border/10 pb-2">
                                <span class="font-semibold text-white">Account Name</span>
                                <span>Natural Science Society</span>
                            </div>
                            <div class="flex justify-between border-b border-glass-border/10 pb-2">
                                <span class="font-semibold text-white">Bank Name</span>
                                <span>Rastriya Banijya Bank</span>
                            </div>
                            <div class="flex justify-between border-b border-glass-border/10 pb-2">
                                <span class="font-semibold text-white">Branch</span>
                                <span>Kirtipur Branch, Kathmandu</span>
                            </div>
                            <div class="flex justify-between border-b border-glass-border/10 pb-2">
                                <span class="font-semibold text-white">Account Number</span>
                                <span class="font-mono text-white text-md tracking-wider">1170100050419001</span>
                            </div>
                            <div class="flex justify-between pb-2">
                                <span class="font-semibold text-white">SWIFT Code</span>
                                <span class="font-mono text-white">RBBANKPA</span>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </section>

    <!-- Membership Application Modal -->
    <div class="membership-modal-overlay" id="membershipModal" onclick="closeMembershipModal()">
        <div class="membership-modal" onclick="event.stopPropagation()">
            <!-- Modal Header -->
            <div class="flex items-center justify-between mb-6 pb-4 border-b border-glass-border/30">
                <div>
                    <h3 class="text-xl font-bold font-heading text-white flex items-center gap-2">
                        <i class="fas fa-id-card text-secondary"></i> Membership Application
                    </h3>
                    <p class="text-text-secondary text-xs mt-1" id="modalPlanLabel">Applying for: <span class="text-secondary font-semibold" id="modalPlanName"></span></p>
                </div>
                <button onclick="closeMembershipModal()" class="text-text-muted hover:text-white transition w-8 h-8 flex items-center justify-center rounded-full hover:bg-white/10">
                    <i class="fas fa-times"></i>
                </button>
            </div>

            <!-- Status Alerts -->
            <div id="membershipSuccess" class="bg-primary/20 border border-primary-accent/40 text-secondary p-4 rounded-lg mb-6 flex items-center gap-3 hidden">
                <i class="fas fa-check-circle text-lg"></i>
                <div>
                    <p class="font-semibold text-sm">Application Submitted!</p>
                    <p class="text-xs text-text-secondary mt-0.5" id="membershipSuccessMsg"></p>
                </div>
            </div>

            <div id="membershipError" class="bg-accent-coral/20 border border-accent-coral/40 text-text-primary p-4 rounded-lg mb-6 hidden">
                <div class="flex items-center gap-2 mb-2 font-semibold text-accent-coral text-sm">
                    <i class="fas fa-exclamation-triangle"></i>
                    <span>Please fix the following:</span>
                </div>
                <ul id="membershipErrorList" class="list-disc pl-6 text-xs text-text-secondary flex flex-col gap-1"></ul>
            </div>

            <!-- Application Form -->
            <form id="membershipForm" onsubmit="submitMembershipForm(event)">
                @csrf
                <input type="hidden" name="subject" id="membershipSubject" value="">

                <div class="grid grid-cols-1 md:grid-cols-2 gap-5 mb-5">
                    <div>
                        <label for="memberName" class="form-label">Full Name <span class="text-accent-coral">*</span></label>
                        <input type="text" id="memberName" name="name" class="form-input" placeholder="e.g. Ram Bahadur Thapa" required>
                    </div>
                    <div>
                        <label for="memberEmail" class="form-label">Email Address <span class="text-accent-coral">*</span></label>
                        <input type="email" id="memberEmail" name="email" class="form-input" placeholder="e.g. ram@gmail.com" required>
                    </div>
                </div>

                <div class="mb-5">
                    <label for="memberMessage" class="form-label">Why do you want to join NSS? <span class="text-accent-coral">*</span></label>
                    <textarea id="memberMessage" name="message" class="form-input h-28 resize-none" placeholder="Tell us briefly about your interest in natural science and conservation..." required></textarea>
                </div>

                <button type="submit" id="membershipSubmitBtn" class="btn-primary w-full text-center justify-center py-3 bg-gradient-to-r from-primary-light to-primary-accent rounded-lg flex items-center gap-2">
                    Submit Application <i class="fas fa-arrow-right text-xs"></i>
                </button>

                <p class="text-text-muted text-[10px] text-center mt-4 leading-relaxed">
                    By submitting, you agree to be contacted regarding your membership. Our team will review and respond within 3–5 business days.
                </p>
            </form>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        const modal = document.getElementById('membershipModal');
        const form = document.getElementById('membershipForm');
        const planNameEl = document.getElementById('modalPlanName');
        const subjectInput = document.getElementById('membershipSubject');

        function openMembershipModal(planType) {
            planNameEl.textContent = planType;
            subjectInput.value = 'Membership Application: ' + planType;

            // Reset form and alerts
            form.reset();
            subjectInput.value = 'Membership Application: ' + planType;
            document.getElementById('membershipSuccess').classList.add('hidden');
            document.getElementById('membershipError').classList.add('hidden');

            modal.classList.add('active');
            document.body.style.overflow = 'hidden';

            // Focus the first input after animation
            setTimeout(() => document.getElementById('memberName').focus(), 300);
        }

        function closeMembershipModal() {
            modal.classList.remove('active');
            document.body.style.overflow = '';
        }

        // Escape key to close
        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape' && modal.classList.contains('active')) {
                closeMembershipModal();
            }
        });

        async function submitMembershipForm(e) {
            e.preventDefault();

            const submitBtn = document.getElementById('membershipSubmitBtn');
            const successAlert = document.getElementById('membershipSuccess');
            const successMsg = document.getElementById('membershipSuccessMsg');
            const errorAlert = document.getElementById('membershipError');
            const errorList = document.getElementById('membershipErrorList');

            // Reset alerts
            successAlert.classList.add('hidden');
            errorAlert.classList.add('hidden');
            errorList.innerHTML = '';

            // Loading state
            submitBtn.disabled = true;
            submitBtn.innerHTML = 'Submitting... <i class="fas fa-spinner fa-spin text-xs"></i>';

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
                    successMsg.textContent = 'Your membership application has been received. We will review it and get back to you shortly.';
                    successAlert.classList.remove('hidden');
                    form.reset();
                    // Auto-close after a delay
                    setTimeout(() => closeMembershipModal(), 4000);
                } else {
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
                li.textContent = 'Network error. Please check your connection and try again.';
                errorList.appendChild(li);
                errorAlert.classList.remove('hidden');
            } finally {
                submitBtn.disabled = false;
                submitBtn.innerHTML = 'Submit Application <i class="fas fa-arrow-right text-xs"></i>';
            }
        }
    </script>
@endsection

