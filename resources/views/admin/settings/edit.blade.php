@extends('layouts.admin')

@section('title', 'Site Settings')
@section('page_title', 'Site Settings')

@section('content')
    <p class="text-text-secondary text-sm mb-6">Manage global website options, contact info, bank details, and social links.</p>

    <div class="admin-card max-w-4xl">
        <form method="POST" action="{{ route('admin.settings.update') }}">
            @csrf
            
            <h3 class="text-text-primary font-heading font-semibold text-lg mb-6 border-b border-glass-border/30 pb-2"><i class="fas fa-info-circle text-secondary mr-2"></i> Contact & Address Info</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                <div>
                    <label for="contact_email" class="form-label">Contact Email Address</label>
                    <input type="email" id="contact_email" name="contact_email" class="form-input" value="{{ old('contact_email', $settings['contact_email'] ?? '') }}" required>
                </div>
                <div>
                    <label for="contact_phone" class="form-label">Contact Phone Number</label>
                    <input type="text" id="contact_phone" name="contact_phone" class="form-input" value="{{ old('contact_phone', $settings['contact_phone'] ?? '') }}" required>
                </div>
                <div class="md:col-span-2">
                    <label for="contact_address" class="form-label">Physical Address</label>
                    <input type="text" id="contact_address" name="contact_address" class="form-input" value="{{ old('contact_address', $settings['contact_address'] ?? '') }}" required>
                </div>
            </div>

            <h3 class="text-text-primary font-heading font-semibold text-lg mb-6 border-b border-glass-border/30 pb-2"><i class="fas fa-university text-secondary mr-2"></i> Bank details for Donations</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                <div>
                    <label for="bank_name" class="form-label">Bank Name</label>
                    <input type="text" id="bank_name" name="bank_name" class="form-input" value="{{ old('bank_name', $settings['bank_name'] ?? '') }}">
                </div>
                <div>
                    <label for="bank_branch" class="form-label">Bank Branch Location</label>
                    <input type="text" id="bank_branch" name="bank_branch" class="form-input" value="{{ old('bank_branch', $settings['bank_branch'] ?? '') }}">
                </div>
                <div>
                    <label for="bank_account_name" class="form-label">Account Holder Name</label>
                    <input type="text" id="bank_account_name" name="bank_account_name" class="form-input" value="{{ old('bank_account_name', $settings['bank_account_name'] ?? '') }}">
                </div>
                <div>
                    <label for="bank_account_no" class="form-label">Account Number</label>
                    <input type="text" id="bank_account_no" name="bank_account_no" class="form-input font-mono" value="{{ old('bank_account_no', $settings['bank_account_no'] ?? '') }}">
                </div>
                <div>
                    <label for="bank_swift_code" class="form-label">SWIFT Code</label>
                    <input type="text" id="bank_swift_code" name="bank_swift_code" class="form-input font-mono" value="{{ old('bank_swift_code', $settings['bank_swift_code'] ?? '') }}">
                </div>
            </div>

            <h3 class="text-text-primary font-heading font-semibold text-lg mb-6 border-b border-glass-border/30 pb-2"><i class="fas fa-file-alt text-secondary mr-2"></i> Page Content Settings</h3>
            <div class="mb-6">
                <label for="about_us_content" class="form-label">About Us Page Content</label>
                @php
                    $defaultAbout = '<p class="text-justify mb-4">The Natural Science Society (NSS) is a non-profit and non-governmental organization that was established in 2020 and is registered with the Government of Nepal. The fact that it is registered with both the District Administration Office in Kathmandu (registration number: 5059) and the Social Welfare Council in Kathmandu (registration number: 52053) demonstrates its commitment to transparency and compliance with local regulations.</p><p class="text-justify mb-4">The organization\'s research team covers a diverse range of fields, including zoology, forestry, economics, and more. This multidisciplinary approach suggests that the NSS aims to address various aspects of natural science and conservation. The capacity to conduct both field and laboratory work further highlights the organization\'s commitment to scientific research and investigation.</p><p class="text-justify mb-4">It is noteworthy that the team members hold at least a master\'s degree from the university, and some are even enrolled in PhD positions. This indicates a strong educational background and expertise within the team. Their knowledge and working experience in the field of conservation biology are particularly valuable, as this field plays a crucial role in preserving and protecting the natural environment.</p><p class="text-justify mb-4">Overall, the Natural Science Society (NSS) appears to be a dedicated organization with a strong scientific foundation, working towards the advancement of knowledge and conservation efforts in Nepal.</p>';
                    $currentAbout = !empty($settings['about_us_content']) ? $settings['about_us_content'] : $defaultAbout;
                @endphp
                <textarea id="about_us_content" name="about_us_content" class="form-input rich-editor">{{ old('about_us_content', $currentAbout) }}</textarea>
                <p class="text-text-muted text-xs mt-2">This content will be displayed on the public About Us page.</p>
            </div>
            <div class="mb-8">
                <label for="contact_page_intro" class="form-label">Contact Page Introduction</label>
                @php
                    $defaultContact = '<p>Have questions about our research projects? Interested in volunteering, collaborating, or donating? Reach out to us using the contact form, or connect directly through our email addresses.</p>';
                    $currentContact = !empty($settings['contact_page_intro']) ? $settings['contact_page_intro'] : $defaultContact;
                @endphp
                <textarea id="contact_page_intro" name="contact_page_intro" class="form-input rich-editor">{{ old('contact_page_intro', $currentContact) }}</textarea>
                <p class="text-text-muted text-xs mt-2">This text appears above the contact form on the public Contact Us page.</p>
            </div>

            <h3 class="text-text-primary font-heading font-semibold text-lg mb-6 border-b border-glass-border/30 pb-2"><i class="fas fa-palette text-secondary mr-2"></i> Website Theme Colors</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                <div>
                    <label for="theme_primary" class="form-label">Primary Color (Base)</label>
                    <div class="flex items-center gap-3">
                        <input type="color" id="theme_primary_picker" class="h-10 w-20 bg-transparent border-0 p-0 rounded cursor-pointer color-picker" value="{{ old('theme_primary', $settings['theme_primary'] ?? '#0e1f34') }}">
                        <input type="text" id="theme_primary" name="theme_primary" class="form-input font-mono uppercase text-sm color-text" value="{{ old('theme_primary', $settings['theme_primary'] ?? '#0e1f34') }}" pattern="^#([A-Fa-f0-9]{6}|[A-Fa-f0-9]{3})$">
                    </div>
                </div>
                <div>
                    <label for="theme_secondary" class="form-label">Secondary / Highlight Color</label>
                    <div class="flex items-center gap-3">
                        <input type="color" id="theme_secondary_picker" class="h-10 w-20 bg-transparent border-0 p-0 rounded cursor-pointer color-picker" value="{{ old('theme_secondary', $settings['theme_secondary'] ?? '#f27c1a') }}">
                        <input type="text" id="theme_secondary" name="theme_secondary" class="form-input font-mono uppercase text-sm color-text" value="{{ old('theme_secondary', $settings['theme_secondary'] ?? '#f27c1a') }}" pattern="^#([A-Fa-f0-9]{6}|[A-Fa-f0-9]{3})$">
                    </div>
                </div>
                <div>
                    <label for="theme_bg" class="form-label">Background Color (Deepest)</label>
                    <div class="flex items-center gap-3">
                        <input type="color" id="theme_bg_picker" class="h-10 w-20 bg-transparent border-0 p-0 rounded cursor-pointer color-picker" value="{{ old('theme_bg', $settings['theme_bg'] ?? '#070f1a') }}">
                        <input type="text" id="theme_bg" name="theme_bg" class="form-input font-mono uppercase text-sm color-text" value="{{ old('theme_bg', $settings['theme_bg'] ?? '#070f1a') }}" pattern="^#([A-Fa-f0-9]{6}|[A-Fa-f0-9]{3})$">
                    </div>
                </div>
                <div>
                    <label for="theme_surface" class="form-label">Surface / Card Color</label>
                    <div class="flex items-center gap-3">
                        <input type="color" id="theme_surface_picker" class="h-10 w-20 bg-transparent border-0 p-0 rounded cursor-pointer color-picker" value="{{ old('theme_surface', $settings['theme_surface'] ?? '#0e1f34') }}">
                        <input type="text" id="theme_surface" name="theme_surface" class="form-input font-mono uppercase text-sm color-text" value="{{ old('theme_surface', $settings['theme_surface'] ?? '#0e1f34') }}" pattern="^#([A-Fa-f0-9]{6}|[A-Fa-f0-9]{3})$">
                    </div>
                </div>
                <div>
                    <label for="theme_text" class="form-label">Primary Text Color</label>
                    <div class="flex items-center gap-3">
                        <input type="color" id="theme_text_picker" class="h-10 w-20 bg-transparent border-0 p-0 rounded cursor-pointer color-picker" value="{{ old('theme_text', $settings['theme_text'] ?? '#f9f8e4') }}">
                        <input type="text" id="theme_text" name="theme_text" class="form-input font-mono uppercase text-sm color-text" value="{{ old('theme_text', $settings['theme_text'] ?? '#f9f8e4') }}" pattern="^#([A-Fa-f0-9]{6}|[A-Fa-f0-9]{3})$">
                    </div>
                </div>
            </div>

            <h3 class="text-text-primary font-heading font-semibold text-lg mb-6 border-b border-glass-border/30 pb-2"><i class="fab fa-facebook text-secondary mr-2"></i> Social Media & External Profiles</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                <div>
                    <label for="facebook_url" class="form-label">Facebook Page URL</label>
                    <input type="text" id="facebook_url" name="facebook_url" class="form-input" value="{{ old('facebook_url', $settings['facebook_url'] ?? '') }}">
                </div>
                <div>
                    <label for="twitter_url" class="form-label">Twitter / X Profile URL</label>
                    <input type="text" id="twitter_url" name="twitter_url" class="form-input" value="{{ old('twitter_url', $settings['twitter_url'] ?? '') }}">
                </div>
                <div>
                    <label for="instagram_url" class="form-label">Instagram Profile URL</label>
                    <input type="text" id="instagram_url" name="instagram_url" class="form-input" value="{{ old('instagram_url', $settings['instagram_url'] ?? '') }}">
                </div>
                <div>
                    <label for="linkedin_url" class="form-label">LinkedIn Organization URL</label>
                    <input type="text" id="linkedin_url" name="linkedin_url" class="form-input" value="{{ old('linkedin_url', $settings['linkedin_url'] ?? '') }}">
                </div>
                <div>
                    <label for="youtube_url" class="form-label">YouTube Channel URL</label>
                    <input type="text" id="youtube_url" name="youtube_url" class="form-input" value="{{ old('youtube_url', $settings['youtube_url'] ?? '') }}">
                </div>
                <div>
                    <label for="researchgate_url" class="form-label">ResearchGate / Scholar Profile URL</label>
                    <input type="text" id="researchgate_url" name="researchgate_url" class="form-input" value="{{ old('researchgate_url', $settings['researchgate_url'] ?? '') }}">
                </div>
            </div>

            <button type="submit" class="btn-primary py-3 px-6">
                <i class="fas fa-save mr-2"></i> Save Settings
            </button>
        </form>
    </div>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Sync color pickers with hex text inputs
        const pickers = document.querySelectorAll('.color-picker');
        
        pickers.forEach(picker => {
            const textInput = picker.nextElementSibling;
            
            // When picker changes, update text
            picker.addEventListener('input', function() {
                textInput.value = this.value.toUpperCase();
            });
            
            // When text changes, update picker (if valid hex)
            textInput.addEventListener('input', function() {
                const val = this.value.trim();
                if (/^#([0-9A-F]{3}){1,2}$/i.test(val)) {
                    // Convert 3-char hex to 6-char hex for the picker
                    if (val.length === 4) {
                        picker.value = '#' + val[1]+val[1] + val[2]+val[2] + val[3]+val[3];
                    } else {
                        picker.value = val;
                    }
                }
            });
        });
    });
</script>
@endsection
