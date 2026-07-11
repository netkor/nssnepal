<?php

namespace Database\Seeders;

use App\Models\Slider;
use App\Models\TeamMember;
use App\Models\Project;
use App\Models\NewsEvent;
use App\Models\Download;
use App\Models\Partner;
use App\Models\SiteSetting;
use App\Models\Opportunity;
use App\Models\Membership;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class ContentSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Create default admin user
        User::updateOrCreate(
            ['email' => 'admin@nssnepal.org'],
            [
                'name' => 'NSS Admin',
                'password' => Hash::make('password123'),
                'role' => 'admin',
                'email_verified_at' => now(),
            ]
        );

        // 2. Homepage Hero Sliders
        Slider::truncate();
        Slider::create([
            'title' => 'Ecology & Conservation of Striped Hyena',
            'subtitle' => 'Exploring habitats, diets, and driving local conservation awareness in Lowland Nepal.',
            'image' => '/images/hero1.jpg',
            'button_text' => 'Learn More',
            'button_url' => '/projects/ecology-and-conservation-of-striped-hyena-hyaena-hyaena-in-lowland-nepal',
            'order' => 1,
            'is_active' => true,
        ]);
        Slider::create([
            'title' => 'Protecting the Endangered Himalayan Musk Deer',
            'subtitle' => 'Mitigating threats, controlling poaching, and empowering local communities in Khaptad National Park.',
            'image' => '/images/hero2.jpg',
            'button_text' => 'Read Our Musk Deer Project',
            'button_url' => '/projects/community-stewardship-for-the-sustainable-conservation-of-himalayan-musk-deer-moschus-chrysogaster-in-khaptad-national-park-nepal',
            'order' => 2,
            'is_active' => true,
        ]);
        Slider::create([
            'title' => 'Fostering Environmental Education',
            'subtitle' => 'Developing nature awareness programs for schools, students, and local groups across Nepal.',
            'image' => '/images/hero3.jpg',
            'button_text' => 'Our Focus Areas',
            'button_url' => '/about-us',
            'order' => 3,
            'is_active' => true,
        ]);

        // 3. Team Members
        TeamMember::truncate();
        
        // Advisors
        TeamMember::create([
            'name' => 'Dionisios Youlatos, PhD',
            'designation' => 'Advisor',
            'role_type' => 'advisor',
            'photo' => null,
            'country' => 'Aristotle University of Thessaloniki, Greece',
            'order' => 1,
        ]);
        TeamMember::create([
            'name' => 'Mr. David Johnson',
            'designation' => 'Advisor',
            'role_type' => 'advisor',
            'photo' => null,
            'country' => 'Denver Zoo and Katie Adamson Conservation Fund, USA',
            'order' => 2,
        ]);

        // Executive Members
        $executives = [
            ['name' => 'Mr. Shivish Bhandari', 'designation' => 'President'],
            ['name' => 'Mr. Anil KC', 'designation' => 'Vice President'],
            ['name' => 'Mr. Tilak Thapamagar', 'designation' => 'Secretary'],
            ['name' => 'Ms. Indra Ghimire', 'designation' => 'Treasurer'],
            ['name' => 'Mr. Sital Budhathoki', 'designation' => 'Member'],
            ['name' => 'Ms. Kasturi Gurung', 'designation' => 'Member'],
            ['name' => 'Ms. Jenish Thakuri', 'designation' => 'Member'],
            ['name' => 'Ms. Punam Sunar', 'designation' => 'Member'],
            ['name' => 'Ms. Anjeela Pandey', 'designation' => 'Member'],
        ];
        foreach ($executives as $index => $exec) {
            TeamMember::create([
                'name' => $exec['name'],
                'designation' => $exec['designation'],
                'role_type' => 'executive',
                'photo' => null,
                'order' => $index + 1,
            ]);
        }

        // Staffs
        TeamMember::create([
            'name' => 'Binaya Adhikari',
            'designation' => 'Coordinator',
            'role_type' => 'staff',
            'photo' => null,
            'order' => 1,
        ]);
        TeamMember::create([
            'name' => 'Rakshya Basnet',
            'designation' => 'Research Assistant',
            'role_type' => 'staff',
            'photo' => null,
            'order' => 2,
        ]);

        // Volunteers
        TeamMember::create([
            'name' => 'Sam Murray',
            'designation' => 'Volunteer',
            'role_type' => 'volunteer',
            'country' => 'USA',
            'order' => 1,
        ]);
        TeamMember::create([
            'name' => 'Bryce Mawhinney',
            'designation' => 'Volunteer',
            'role_type' => 'volunteer',
            'country' => 'USA',
            'order' => 2,
        ]);

        // 4. Projects
        Project::truncate();
        
        // Ongoing
        Project::create([
            'title' => 'Ecology and conservation of striped hyena (hyaena hyaena) in lowland, Nepal',
            'slug' => 'ecology-and-conservation-of-striped-hyena-hyaena-hyaena-in-lowland-nepal',
            'description' => 'Exploring the suitable habitat, diet analysis, and estimating the population of striped hyena in lowland Nepal, while developing community conservation awareness programs.',
            'content' => '<p>The striped hyena (Hyaena hyaena) is one of the key carnivores in Nepal, facing severe threats due to habitat loss, human conflict, and persecution. This research project aims to:</p><ul><li>Explore the suitable habitat, diet analysis and estimate the population of hyena in lowland regions of Nepal.</li><li>Develop community conservation awareness programs highlighting the species ecological role.</li><li>Promote the hyena conservation work at the local level.</li></ul>',
            'status' => 'ongoing',
            'featured_image' => null,
            'order' => 1,
        ]);
        Project::create([
            'title' => 'Nesting ecology and conservation of the lesser adjutant in Eastern Nepal',
            'slug' => 'nesting-ecology-and-conservation-of-the-lesser-adjutant-in-eastern-nepal',
            'description' => 'Investigating nesting ecology and understanding the direct impacts of pesticides and agricultural runoff on the lesser adjutant storks in Eastern Nepal.',
            'content' => '<p>The lesser adjutant is a globally threatened stork species inhabiting wetlands and agricultural landscapes. This project focuses on nesting sites and threat analysis in Eastern Nepal.</p><p>Key Objectives:</p><ul><li>Analyze nesting ecology, tree preference, and hatching success rate.</li><li>Understand the effect of pesticides and chemicals on the lesser adjutant and its food sources.</li></ul>',
            'status' => 'ongoing',
            'featured_image' => null,
            'order' => 2,
        ]);

        // Completed
        Project::create([
            'title' => 'Tiger (Panthera tigris) conservation project in lowland of Nepal',
            'slug' => 'tiger-panthera-tigris-conservation-project-in-lowland-of-nepal',
            'description' => 'Conducted comprehensive school awareness programs, village discussions, and scientific food/habitat analyses to mitigate human-tiger conflicts in the Parsa-Chitwan Complex.',
            'content' => '<p>The endangered Bengal tiger is one of the top predators of the forest and grassland ecosystems. This project aimed to conduct conservation awareness programs for long term conservation of tigers in Nepal. We conducted school awareness programs and village group discussions to mitigate human-tiger conflict in Parsa-Chitwan Complex, Nepal.</p><p>Our specific objectives were:</p><ul><li>To understand the food behavior of tigers.</li><li>To know the habitat suitability and movement ecology of tigers.</li><li>To minimize the human-tiger conflict in Nepal\'s lowland.</li></ul>',
            'status' => 'completed',
            'featured_image' => null,
            'order' => 3,
        ]);
        Project::create([
            'title' => 'Community stewardship for the sustainable conservation of Himalayan musk deer (Moschus chrysogaster) in Khaptad National Park, Nepal',
            'slug' => 'community-stewardship-for-the-sustainable-conservation-of-himalayan-musk-deer-moschus-chrysogaster-in-khaptad-national-park-nepal',
            'description' => 'A major community conservation initiative targeting park rangers, school students, and buffer zone committees to save the Endangered musk deer in Khaptad National Park.',
            'content' => '<p>Himalayan musk deer is one of the highlighted species in the Himalayan region and listed as \'Endangered\' by IUCN Red List Category. It is also protected species by Nepal\'s National Park and Wildlife Conservation Act, 1973. Musk deer are facing high threats; killing of musk deer by poachers for musk pod extraction is one of the greatest threats for this species so the population is in decreasing trend. Musk deer distribute at altitudinal range of 2,000-5,000 m asl. Due to poaching, deforestation, habitat fragmentation and degradation, population of musk deer has been declining dramatically. Moreover, livestock depredation, overgrazing, forest fire, human encroachment for firewood and medicinal herbs collection are additional threats to the musk deer in this area.</p><p>KNP lies in western part of Nepal and is a home for highly threatened species - snow leopard, red panda, musk deer, and several birds and plant species. Poaching, people hunting musk deer for meat, skin and tusk is one of the major problems. In this project, our overall goal was to conserve musk deer in KNP. This project contributed for long term conservation of the musk deer. Our project targeted local community, park rangers and game-scouts, traders, buffer zone committee and school students to take conservation activities in KNP.</p>',
            'status' => 'completed',
            'featured_image' => null,
            'order' => 4,
        ]);

        // 5. Scientific Publications
        Download::truncate();
        
        $publications = [
            [
                'title' => 'Impact of climate change on distribution of common leopard (Panthera pardus) and its implication on conservation and conflict in Nepal',
                'authors' => 'Baral, K., Adhikari, B., Bhandari, S., Kunwar, R. M., Sharma, H. P., Aryal, A., & Ji, W.',
                'journal' => 'Heliyon, e12807',
                'year' => 2023,
                'type' => 'publication',
                'file_path' => 'https://doi.org/10.1016/j.heliyon.2023.e12807',
            ],
            [
                'title' => 'Anthropogenic mortality of large mammals and trends of conflict over two decades in Nepal',
                'authors' => 'Baral, K., Bhandari, S., Adhikari, B., Kunwar, R. M., Sharma, H. P., Aryal, A., & Ji, W.',
                'journal' => 'Ecology and Evolution, 12(10), e9381',
                'year' => 2022,
                'type' => 'publication',
                'file_path' => 'https://doi.org/10.1002/ece3.9381',
            ],
            [
                'title' => 'Raptors at risk: Attributes of mortality within an anthropogenic landscape in the Mid-Hills region of Nepal',
                'authors' => 'Adhikari, B., Bhandari, S., Baral, K., Lamichhane, S., & Subedi, S. C.',
                'journal' => 'Global Ecology and Conservation, 38, e02258',
                'year' => 2022,
                'type' => 'publication',
                'file_path' => 'https://doi.org/10.1016/j.gecco.2022.e02258',
            ],
            [
                'title' => 'Prevalence of mortality in mammals: A retrospective study from wildlife rescue center of Nepal',
                'authors' => 'Adhikari, B., Baral, K., Bhandari, S., Kunwar, R. M., & Subedi, S. C.',
                'journal' => 'Conservation Science and Practice, e12799',
                'year' => 2022,
                'type' => 'publication',
                'file_path' => 'https://doi.org/10.1111/csp2.12799',
            ],
            [
                'title' => 'Climate change threatens striped hyena (Hyaena hyaena) distribution in Nepal',
                'authors' => 'Bhandari, S., Adhikari, B., Baral, K., Panthi, S., Kunwar, R. M., Thapamagar, T., ... & Youlatos, D.',
                'journal' => 'Mammal Research, 67: 433–443',
                'year' => 2022,
                'type' => 'publication',
                'file_path' => 'https://doi.org/10.1007/s13364-022-00629-6',
            ],
            [
                'title' => 'Greater one-horned rhino (Rhinoceros unicornis) mortality patterns in Nepal',
                'authors' => 'Bhandari, S., Adhikari, B., Baral, K., & Subedi, S. C.',
                'journal' => 'Global Ecology and Conservation, e02189',
                'year' => 2022,
                'type' => 'publication',
                'file_path' => 'https://doi.org/10.1016/j.gecco.2022.e02189',
            ],
            [
                'title' => 'Spatial segregation between wild ungulates and livestock outside protected areas in the lowlands of Nepal',
                'authors' => 'Bhandari S, Ramiro DC, Stabach JA',
                'journal' => 'PloSOne, 17(1): e0263122',
                'year' => 2022,
                'type' => 'publication',
                'file_path' => 'https://doi.org/10.1371/journal.pone.0263122',
            ],
            [
                'title' => 'Potential risk zone for anthropogenic mortality of carnivores in Gandaki Province, Nepal',
                'authors' => 'Adhikari, B., Baral, K., Bhandari, S., Szydlowski, M., Kunwar, R. M., Panthi, S., Neupane, B., & Koirala, R. K.',
                'journal' => 'Ecology and Evolution, 12, e8491',
                'year' => 2022,
                'type' => 'publication',
                'file_path' => 'https://doi.org/10.1002/ece3.8491',
            ],
            [
                'title' => 'Habitat preference indicators for striped hyena (Hyaena hyaena) in Nepal',
                'authors' => 'Bhandari S, DR Bhusal, M Psaralexi, S Sgardelis',
                'journal' => 'Global Ecology and Conservation. 27, e01619',
                'year' => 2021,
                'type' => 'publication',
                'file_path' => 'https://doi.org/10.1016/j.gecco.2021.e01619',
            ],
            [
                'title' => 'Shrinking striped hyena (Hyaena hyaena Linnaeus, 1758) distribution in Nepal',
                'authors' => 'Bhandari S, Youlatos D, Thapamagar T, Bhusal DR',
                'journal' => 'European Journal of Wildlife Research. 67, 10',
                'year' => 2021,
                'type' => 'publication',
                'file_path' => 'https://doi.org/10.1007/s10344-020-01449-0',
            ],
        ];

        foreach ($publications as $pub) {
            Download::create(array_merge($pub, ['published_at' => date($pub['year'].'-01-01 00:00:00')]));
        }

        // Add dummy report placeholder
        Download::create([
            'title' => 'NSS Annual Project Activity Report',
            'description' => 'Overview of active conservation projects, budgets, and field work achievements.',
            'type' => 'report',
            'year' => 2025,
            'file_path' => '#',
            'published_at' => now(),
        ]);

        // 6. Opportunities
        Opportunity::truncate();
        Opportunity::create([
            'title' => 'Masters Degree Thesis & Research Grant',
            'type' => 'thesis_grant',
            'content' => '<p>We support thesis grants for Master\'s Degree students conducting research in biodiversity, wildlife ecology, and environmental conservation in Nepal.</p><p><strong>Status:</strong> There is no current active announcement, but students are welcome to submit research outlines for upcoming cycles.</p><p><em>Past Recipient (2022):</em> Ms. Keshari Thapamagar (Grant amount: NRs. 45,000.00 for Musk Deer Conservation in Makalu Barun National Park).</p>',
            'is_active' => true,
        ]);
        Opportunity::create([
            'title' => 'Volunteering & Internship Opportunities',
            'type' => 'volunteer',
            'content' => '<p>We accept applications from national and international university students and young researchers. If you are interested in volunteering or interning at the Natural Science Society, please email us with a copy of your CV and a brief description of projects or areas you have in mind.</p><p>For more details, contact Shivish Bhandari (shivish.bhandari@yahoo.com).</p>',
            'is_active' => true,
        ]);

        // 7. Memberships
        Membership::truncate();
        Membership::create([
            'type' => 'Student Membership',
            'cost_initial' => 200.00,
            'cost_yearly' => 100.00,
            'description' => 'For active students in high schools and universities. Grants access to library resources, newsletters, and volunteer lists.',
            'order' => 1,
        ]);
        Membership::create([
            'type' => 'General Membership',
            'cost_initial' => 1000.00,
            'cost_yearly' => 500.00,
            'description' => 'For professional researchers, conservationists, or interested individuals. Grants voting privileges and priority invites to seminars.',
            'order' => 2,
        ]);
        Membership::create([
            'type' => 'Lifetime Membership',
            'cost_initial' => 5000.00,
            'cost_yearly' => 0.00,
            'description' => 'One-time support option for dedicated life-long supporters of Natural Science Society.',
            'order' => 3,
        ]);

        // 8. Partners
        Partner::truncate();
        Partner::create([
            'name' => 'Katie Adamson Conservation Fund (KACF)',
            'url' => 'https://www.katieadamsonconservationfund.org',
            'logo' => null,
            'order' => 1,
        ]);
        Partner::create([
            'name' => 'Idea Wild',
            'url' => 'http://www.ideawild.org',
            'logo' => null,
            'order' => 2,
        ]);

        // 9. Site Settings
        SiteSetting::truncate();
        SiteSetting::set('contact_email', 'info@nssnepal.org.np');
        SiteSetting::set('contact_phone', '+977-9849987348');
        SiteSetting::set('contact_address', 'Kirtipur 5, Kathmandu, Nepal');
        SiteSetting::set('facebook_url', 'https://www.facebook.com/naturalsciencesocietynepal');
        SiteSetting::set('bank_name', 'Rastriya Banijya Bank');
        SiteSetting::set('bank_branch', 'Kirtipur Branch, Kathmandu, Nepal');
        SiteSetting::set('bank_account_name', 'Natural Science Society');
        SiteSetting::set('bank_account_no', '1170100050419001');
        SiteSetting::set('bank_swift_code', 'RBBANPKA');

        // Dynamic Pages Default Content
        SiteSetting::set('contact_page_intro', '<p>Have questions about our research projects? Interested in volunteering, collaborating, or donating? Reach out to us using the contact form, or connect directly through our email addresses.</p>');
        
        $aboutUsContent = '<p class="text-justify mb-4">The Natural Science Society (NSS) is a non-profit and non-governmental organization that was established in 2020 and is registered with the Government of Nepal. The fact that it is registered with both the District Administration Office in Kathmandu (registration number: 5059) and the Social Welfare Council in Kathmandu (registration number: 52053) demonstrates its commitment to transparency and compliance with local regulations.</p>
<p class="text-justify mb-4">The organization\'s research team covers a diverse range of fields, including zoology, forestry, economics, and more. This multidisciplinary approach suggests that the NSS aims to address various aspects of natural science and conservation. The capacity to conduct both field and laboratory work further highlights the organization\'s commitment to scientific research and investigation.</p>
<p class="text-justify mb-4">It is noteworthy that the team members hold at least a master\'s degree from the university, and some are even enrolled in PhD positions. This indicates a strong educational background and expertise within the team. Their knowledge and working experience in the field of conservation biology are particularly valuable, as this field plays a crucial role in preserving and protecting the natural environment.</p>
<p class="text-justify mb-4">Overall, the Natural Science Society (NSS) appears to be a dedicated organization with a strong scientific foundation, working towards the advancement of knowledge and conservation efforts in Nepal.</p>';
        SiteSetting::set('about_us_content', $aboutUsContent);

        // 10. News & Events
        NewsEvent::truncate();
        NewsEvent::create([
            'title' => 'Upcoming Bird Watching Program in Kathmandu Valley',
            'slug' => 'upcoming-bird-watching-program-in-kathmandu-valley',
            'excerpt' => 'Join the Natural Science Society for a weekend of birdwatching and biodiversity education in the surrounding hills of Kathmandu.',
            'content' => '<p>We are excited to announce our upcoming bird watching program in the Kathmandu valley! This educational event is designed to introduce students, researchers, and local nature enthusiasts to the diverse avian species in the mid-hills ecosystem.</p><p>We will explore key bird habitats, record sightings, and discuss local threat indicators. Please stay tuned or email us to register. Thank you so much!</p>',
            'type' => 'event',
            'featured_image' => null,
            'published_at' => now(),
            'is_published' => true,
        ]);
    }
}
