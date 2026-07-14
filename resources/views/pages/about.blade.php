@extends('layouts.app')

@section('title', 'About Us | Natural Science Society (NSS) Nepal')

@section('content')
    <!-- Banner Page Header -->
    <header class="page-header">
        <div class="container mx-auto px-4 md:px-8 relative z-10">
            <span class="text-secondary text-sm font-semibold tracking-widest uppercase mb-2 block">Our Foundations</span>
            <h1 class="text-4xl md:text-5xl font-heading font-extrabold text-text-primary">About Us</h1>
            <div class="section-divider mx-auto"></div>
        </div>
    </header>

    <!-- Mission & Vision Section -->
    <section class="py-20 bg-dark-bg">
        <div class="container mx-auto px-4 md:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 mb-16">
                <!-- Mission Box -->
                <div class="glass-card p-8 md:p-10 animate-on-scroll relative overflow-hidden">
                    <div class="absolute right-6 top-6 text-primary-light/10 text-6xl font-bold font-heading"><i class="fas fa-bullseye"></i></div>
                    <span class="text-primary-muted font-bold text-xs uppercase tracking-widest block mb-2">Empowering Actions</span>
                    <h2 class="text-2xl md:text-3xl font-heading font-bold text-text-primary mb-4">Our Mission</h2>
                    <p class="text-text-secondary text-md text-justify leading-relaxed">
                        To conduct scientific research in biodiversity conservation, facilitate nature literacy, and establish active conservation stewardship programs. We seek to protect ecosystems through scientific understanding and grass-roots public mobilization.
                    </p>
                </div>

                <!-- Vision Box -->
                <div class="glass-card p-8 md:p-10 animate-on-scroll delay-1 relative overflow-hidden">
                    <div class="absolute right-6 top-6 text-primary-light/10 text-6xl font-bold font-heading"><i class="fas fa-eye"></i></div>
                    <span class="text-accent-gold text-xs font-bold uppercase tracking-widest block mb-2">Inspiring Tomorrow</span>
                    <h2 class="text-2xl md:text-3xl font-heading font-bold text-text-primary mb-4">Our Vision</h2>
                    <p class="text-text-secondary text-md text-justify leading-relaxed">
                        A harmonious coexistence between humans and nature in Nepal, where communities are active guardians of their local ecological resources, backed by evidence-based scientific research.
                    </p>
                </div>
            </div>

            <!-- Details Section -->
            <div class="max-w-4xl mx-auto text-center mb-16 animate-on-scroll">
                <h3 class="text-2xl font-bold font-heading text-text-primary mb-6">Who We Are & What We Do</h3>
                
                @if(!empty($siteSettings['about_us_content']))
                    <div class="prose prose-invert max-w-none text-text-secondary leading-relaxed text-justify mx-auto">
                        {!! $siteSettings['about_us_content'] !!}
                    </div>
                @else
                    <p class="text-text-secondary leading-relaxed mb-6 text-justify">
                        The Natural Science Society (NSS) is a non-profit and non-governmental organization that was established in 2020 and is registered with the Government of Nepal. The fact that it is registered with both the District Administration Office in Kathmandu (registration number: 5059) and the Social Welfare Council in Kathmandu (registration number: 52053) demonstrates its commitment to transparency and compliance with local regulations.
                    </p>
                    <p class="text-text-secondary leading-relaxed mb-6 text-justify">
                        The organization's research team covers a diverse range of fields, including zoology, forestry, economics, and more. This multidisciplinary approach suggests that the NSS aims to address various aspects of natural science and conservation. The capacity to conduct both field and laboratory work further highlights the organization's commitment to scientific research and investigation.
                    </p>
                    <p class="text-text-secondary leading-relaxed text-justify">
                        It is noteworthy that the team members hold at least a master's degree from the university, and some are even enrolled in PhD positions. This indicates a strong educational background and expertise within the team. Their knowledge and working experience in the field of conservation biology are particularly valuable, as this field plays a crucial role in preserving and protecting the natural environment.
                    </p>
                    <p class="text-text-secondary leading-relaxed text-justify mt-6">
                        Overall, the Natural Science Society (NSS) appears to be a dedicated organization with a strong scientific foundation, working towards the advancement of knowledge and conservation efforts in Nepal.
                    </p>
                @endif
            </div>

            <!-- Focus Areas -->
            <div class="border-t border-glass-border/30 pt-16">
                <div class="text-center mb-12 animate-on-scroll">
                    <span class="text-primary-muted font-bold text-xs uppercase tracking-widest block mb-2">Our Key Activities</span>
                    <h2 class="text-3xl font-heading font-bold text-text-primary">Focus Areas</h2>
                    <div class="section-divider mx-auto"></div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <!-- Area 1 -->
                    <div class="glass-card p-6 flex flex-col gap-4 animate-on-scroll">
                        <div class="w-12 h-12 rounded-lg bg-primary-light/20 flex items-center justify-center text-secondary text-xl">
                            <i class="fas fa-paw"></i>
                        </div>
                        <h3 class="text-lg font-bold text-text-primary">Wildlife Ecology & Monitoring</h3>
                        <p class="text-text-secondary text-justify text-sm">
                            We perform active field research, habitat suitability mapping, diet analysis, and conflict threat modeling on threatened carnivores and herbivores like Common Leopards, Striped Hyenas, and Himalayan Musk Deer.
                        </p>
                    </div>

                    <!-- Area 2 -->
                    <div class="glass-card p-6 flex flex-col gap-4 animate-on-scroll delay-1">
                        <div class="w-12 h-12 rounded-lg bg-primary-light/20 flex items-center justify-center text-secondary text-xl">
                            <i class="fas fa-school"></i>
                        </div>
                        <h3 class="text-lg font-bold text-text-primary">Environmental Education</h3>
                        <p class="text-text-secondary text-justify text-sm">
                            NSS designs nature education materials, conducts school awareness workshops, runs village-level group discussions, and hosts bird-watching activities to cultivate conservation literacy in children and adults.
                        </p>
                    </div>

                    <!-- Area 3 -->
                    <div class="glass-card p-6 flex flex-col gap-4 animate-on-scroll delay-2">
                        <div class="w-12 h-12 rounded-lg bg-primary-light/20 flex items-center justify-center text-secondary text-xl">
                            <i class="fas fa-users-cog"></i>
                        </div>
                        <h3 class="text-lg font-bold text-text-primary">Community & Youth Empowerment</h3>
                        <p class="text-text-secondary text-justify text-sm">
                            Through thesis grants, internships, and workshops, we mentor local youth and park rangers. We establish community stewardship structures to counter illegal poaching and habitat fragmentation.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
