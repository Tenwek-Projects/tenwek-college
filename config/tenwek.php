<?php

return [
    'name' => env('TENWEK_COLLEGE_NAME', 'Tenwek Hospital College'),
    'tagline' => env('TENWEK_COLLEGE_TAGLINE', 'Excellence in medical, nursing, and chaplaincy education, rooted in Christ-minded service.'),
    'institution_legal' => env('TENWEK_INSTITUTION_LEGAL', 'Tenwek Hospital College'),
    'url' => env('APP_URL', 'https://tenwekhospitalcollege.ac.ke'),
    'locale' => env('APP_LOCALE', 'en_KE'),
    'email_public' => env('TENWEK_PUBLIC_EMAIL', 'info@tenwekhospitalcollege.ac.ke'),
    'phone' => env('TENWEK_PUBLIC_PHONE', '+254 700 000 000'),
    'address' => [
        'street' => 'P.O. Box 39, 20400',
        'locality' => 'Bomet',
        'region' => 'Bomet County',
        'country' => 'KE',
        'country_name' => 'Kenya',
    ],
    'geo' => [
        'latitude' => env('TENWEK_GEO_LAT', '-0.7792'),
        'longitude' => env('TENWEK_GEO_LNG', '35.3369'),
    ],
    'hospital' => [
        'name' => 'Tenwek Hospital',
        'url' => 'https://tenwek.designekta.com/',
    ],
    'ctc' => [
        'name' => 'Tenwek Cardiothoracic Centre',
        'url' => 'https://ctc.designekta.com/',
    ],

    /**
     * Public /contact page: copy for hospital & CTC directory cards.
     * College and school details are pulled from soc_landing.contact, cohs_landing.contact_page, and email_public.
     */
    'contact_directory' => [
        'intro' => 'Tenwek Hospital College sits alongside Tenwek Hospital in Bomet. Use the directory below to reach the School of Chaplaincy, the College of Health Sciences, the main hospital, or the Cardiothoracic Centre-or send us a message and we will route it appropriately.',
        'hospital' => [
            'tagline' => 'Level 5 teaching and referral hospital-clinical home for our health sciences students and the wider community.',
            'phone' => env('TENWEK_HOSPITAL_PHONE', '+254 728 091 900'),
            'email' => env('TENWEK_HOSPITAL_EMAIL'),
        ],
        'ctc' => [
            'tagline' => 'Specialised cardiothoracic surgical care and partnerships as part of the Tenwek ecosystem.',
            'phone' => env('TENWEK_CTC_PHONE'),
            'email' => env('TENWEK_CTC_EMAIL'),
        ],
    ],

    /** Defaults match the legacy WordPress college site; override with env or set to empty string to hide. */
    'social' => array_filter([
        'facebook' => env('TENWEK_SOCIAL_FACEBOOK', 'https://www.facebook.com/TenwekHospital/'),
        'instagram' => env('TENWEK_SOCIAL_INSTAGRAM', 'https://www.instagram.com/tenwekhospital/'),
        'linkedin' => env('TENWEK_SOCIAL_LINKEDIN', 'https://www.linkedin.com/company/tenwek-hospital/'),
        'youtube' => env('TENWEK_SOCIAL_YOUTUBE'),
        'x' => env('TENWEK_SOCIAL_X', 'https://twitter.com/tenwekhosp'),
    ]),
    'default_og_image' => 'ctc.jpg',

    /** Public path under public/ or absolute http(s) URL for the official circular seal. */
    'brand_logo' => env('TENWEK_BRAND_LOGO', 'Tenwek-collge-logo.png'),

    'hero' => [
        'credibility' => env('TENWEK_HERO_CREDIBILITY', 'Est. 1937 · Level 5 Teaching & Referral · Bomet, Kenya'),
        'image' => env('TENWEK_HERO_IMAGE', 'ctc.jpg'),
        'image_alt' => env('TENWEK_HERO_IMAGE_ALT', 'Tenwek Hospital College - clinical and academic excellence in Bomet, Kenya'),
    ],

    'landing' => [
        'cream_bg' => env('TENWEK_LANDING_SECTION_BG', '#FFFFFF'),
        'soc_purple' => env('TENWEK_SOC_CARD_BG', '#8265ae'),
        /** Hero image for School of Chaplaincy card on the home page (under public/). */
        'soc_card_image' => env('TENWEK_SOC_CARD_IMAGE', 'banner-a.jpg'),
        /** Hero image for College of Health Sciences / nursing card on the home page (under public/). */
        'cohs_card_image' => env('TENWEK_COHS_CARD_IMAGE', 'banner-nursing.jpg'),
        'pillars' => [
            [
                'title' => 'Clinical training',
                'description' => 'Hands-on education anchored at Tenwek Hospital - a Level 5 teaching and referral mission hospital serving Kenya and the wider region.',
                'route' => 'pages.show',
                'params' => ['slug' => 'clinical-training'],
                'cta' => 'Learn more',
            ],
            [
                'title' => 'Trusted governance',
                'description' => 'Transparent policies, academic integrity, and spiritual formation woven into every programme.',
                'route' => 'pages.show',
                'params' => ['slug' => 'governance'],
                'cta' => 'Governance',
            ],
            [
                'title' => 'Downloads hub',
                'description' => 'Admission packs, clinical placement forms, and student resources - searchable and kept current.',
                'route' => 'downloads.index',
                'params' => [],
                'cta' => 'Browse downloads',
            ],
        ],
    ],

    /**
     * School of Chaplaincy landing (/soc): section flow aligned with
     * https://tenwekhospitalcollege.ac.ke/soc/ (hero → about → mission/vision → motto → testimonials → contact).
     */
    'soc_landing' => [
        /** Navbar mark for /soc (file under public/). */
        'logo' => env('TENWEK_SOC_LOGO', 'Tenwek-collge-logo.png'),
        'hero_image' => env('TENWEK_SOC_LANDING_HERO_IMAGE', 'banner-a.jpg'),
        'about_image' => env('TENWEK_SOC_LANDING_ABOUT_IMAGE', 'banner-a.jpg'),
        'map_embed_url' => env('TENWEK_SOC_MAP_EMBED_URL', 'https://maps.google.com/maps?q=-0.7792,35.3369&z=14&output=embed'),
        /** Managed from admin (SOC → SEO). Null values fall back to auto-generated meta. */
        'landing_seo' => [
            'title' => null,
            'description' => null,
            'keywords' => null,
            'canonical' => null,
            'og_title' => null,
            'og_description' => null,
            'og_image' => null,
            'robots' => null,
        ],
        'nav_sections' => [
            ['id' => 'about', 'label' => 'About'],
            ['id' => 'mission-vision', 'label' => 'Mission & vision'],
            ['id' => 'motto', 'label' => 'Motto'],
            ['id' => 'testimonials', 'label' => 'Testimonials'],
            ['id' => 'contact', 'label' => 'Contact'],
        ],
        /**
         * Primary SOC header links (mirrors http://tenwekhospitalcollege.ac.ke/soc/ menu hierarchy).
         * Slugs are School of Chaplaincy page slugs (see TenwekFoundationSeeder).
         */
        'main_nav' => [
            [
                'label' => 'About Us',
                'children' => [
                    ['label' => 'Our History', 'slug' => 'our-history'],
                    ['label' => 'Message from the Principal', 'slug' => 'message-from-the-principal'],
                    ['label' => 'Board and Management Team', 'slug' => 'board-and-management-team'],
                    ['label' => 'Strategic Partners', 'slug' => 'strategic-partners'],
                ],
            ],
            ['label' => 'Academic Programmes', 'slug' => 'academic-programmes'],
            ['label' => 'Fees', 'slug' => 'fee'],
            ['label' => 'Admissions', 'slug' => 'admissions'],
            ['label' => 'Gallery', 'slug' => 'gallery'],
            ['label' => 'FAQs', 'slug' => 'faqs'],
        ],
        'hero' => [
            'badge' => 'Equipping chaplains for wholistic service',
            'eyebrow' => 'Tenwek Hospital College · School of Chaplaincy',
            'headline' => 'School of Chaplaincy',
            'subhead' => 'The best place for chaplaincy education: Christ-centred, academically rigorous, and rooted in compassionate hospital ministry.',
            'primary_cta' => ['label' => 'Choose a programme', 'route' => 'schools.pages.show', 'params' => ['school' => 'soc', 'pageSlug' => 'academic-programmes']],
            'secondary_cta' => ['label' => 'Talk to us today', 'hash' => 'contact'],
        ],
        'about' => [
            'kicker' => 'Karibu',
            'title' => 'The Tenwek Hospital College School of Chaplaincy',
            'lead' => 'Excellence in healthcare chaplaincy, forming leaders who serve the whole person.',
            'paragraphs' => [
                'The Tenwek Hospital College - School of Chaplaincy was established in 1991 as the L. Nelson Bell Chaplaincy Training School. Dr. Ernie Steury, who was the first doctor to serve at Tenwek Hospital, realized that the institution needed full-time chaplains to serve alongside the dedicated medical team.',
                'There was no college or university offering training in chaplaincy at the time. That gap gave birth to the vision of opening a chaplaincy school at Tenwek Hospital: a vision we continue to live out today.',
            ],
        ],
        /**
         * Public About us page (/soc/about-us): hero band and featured image under public/.
         */
        'about_page' => [
            'kicker' => 'Tenwek Hospital College',
            /** Brand purple - matches legacy #8265ae / --color-thc-royal */
            'accent' => '#8265ae',
            'hero_image' => env('TENWEK_SOC_ABOUT_IMAGE', 'about.jpg'),
            'hero_image_alt' => env('TENWEK_SOC_ABOUT_IMAGE_ALT', 'Tenwek Hospital College - School of Chaplaincy'),
            'core_values_heading' => 'Our core values',
            'programmes_cta_label' => 'Our programmes',
            'core_values' => [
                ['title' => 'Holiness', 'text' => 'Promoting Christ-like life as demonstrated by His love and empathy.'],
                ['title' => 'Servanthood', 'text' => 'Dedicated to serve God and humanity.'],
                ['title' => 'Professionalism', 'text' => 'Promoting knowledge and excellence in the ministry of chaplaincy.'],
                ['title' => 'Integrity', 'text' => 'Promoting accountability and good stewardship of resources, and adherence to moral and ethical values.'],
                ['title' => 'Resilience', 'text' => 'Ability to withstand and cope with stress and challenges of all kinds.'],
                ['title' => 'Timeliness', 'text' => 'We are committed to deliver what is required of us in a timely and appropriate manner.'],
                ['title' => 'Teamwork', 'text' => 'Diverse individuals committed to a shared vision.'],
            ],
        ],
        'vision' => [
            'title' => 'Vision',
            'text' => 'Christ transformed and competent professionals serving humanity.',
        ],
        'mission' => [
            'title' => 'Mission',
            'text' => 'To prepare Christ-like professionals for competent service through holistic, quality, Bible-centred training and research.',
        ],
        'motto' => [
            'kicker' => 'Our motto',
            'text' => 'To equip chaplains for wholistic service.',
        ],
        'testimonials' => [
            'kicker' => 'Chaplains say',
            'title' => 'Testimonials',
            'items' => [
                [
                    'role' => 'Retired chaplain',
                    'quote' => 'I served as a chaplain at Tenwek Hospital for the better part of my adult life. This was a fulfilling experience and I witnessed first-hand how God uses chaplains to inspire, encourage and comfort His people. Given the opportunity, I would go back to the Tenwek Hospital College School of Chaplaincy to get formal training.',
                    'name' => 'Mrs. Hellen Tangus',
                ],
                [
                    'role' => 'Alumnae, School of Chaplaincy',
                    'quote' => 'I am a trained secondary school teacher by profession and I was quite disturbed to see young girls and boys lose their way to the world. I chose to study chaplaincy and this is the best decision I have made so far. The experience and skills I gained from Tenwek Hospital College School of Chaplaincy prepared me to handle numerous situations within my line of duty.',
                    'name' => 'Robert Sang',
                ],
            ],
        ],
        /**
         * /soc/our-history: narrative from https://tenwekhospitalcollege.ac.ke/soc/our-history/
         * plus structured milestones for the timeline UI.
         */
        'our_history' => [
            'kicker' => 'About School of Chaplaincy',
            'intro_paragraphs' => [
                'The Tenwek Hospital College - School of Chaplaincy was established in 1991 as the L. Nelson Bell Chaplaincy Training School. Dr. Ernie Steury, who was the first doctor to serve at Tenwek Hospital, realised that the institution needed full-time chaplains to serve alongside the dedicated medical team. There was no college or university offering training in chaplaincy at the time, and that gave birth to the vision of opening one at Tenwek Hospital.',
                'Over 29 years later, the school had trained more than 200 students from various African nations including Rwanda, Zambia, Zimbabwe, Malawi, Uganda, Tanzania, Ghana, Nigeria, Madagascar and the Democratic Republic of Congo (DRC).',
                'Due to changing chaplaincy needs, the school has redesigned and upgraded its curriculum. This ensures consistency with the ongoing development of competency-based curriculum in all institutions of learning in Kenya. The school is working closely with Technical and Vocational Education and Training - Curriculum Development, Assessment and Certification Council (TVET - CDACC) in the development of Certificate and Diploma in Chaplaincy curricula that is nearing completion. The school envisions developing other areas of specialisation in chaplaincy alongside further study levels to advance chaplaincy as a field of professional growth.',
            ],
            'milestones' => [
                [
                    'year' => '1991',
                    'title' => 'L. Nelson Bell Chaplaincy Training School',
                    'body' => 'The School of Chaplaincy opens at Tenwek Hospital: the first dedicated response to the need for full-time, professionally formed chaplains alongside the medical team.',
                ],
                [
                    'year' => '1991-2020',
                    'title' => 'Formation across Africa',
                    'body' => 'In the decades following its founding, the school trained more than 200 students from Rwanda, Zambia, Zimbabwe, Malawi, Uganda, Tanzania, Ghana, Nigeria, Madagascar and the Democratic Republic of Congo (DRC), among others.',
                ],
                [
                    'year' => 'Today',
                    'title' => 'Competency-based curriculum & TVET - CDACC',
                    'body' => 'The curriculum has been redesigned and upgraded to align with competency-based education in Kenya. The school partners with TVET - CDACC on Certificate and Diploma in Chaplaincy programmes nearing completion, with a vision for further specialisations and study levels.',
                ],
            ],
            'about_sidebar' => [
                ['label' => 'Our History', 'slug' => 'our-history'],
                ['label' => 'Message from the Principal', 'slug' => 'message-from-the-principal'],
                ['label' => 'Board and Management Team', 'slug' => 'board-and-management-team'],
                ['label' => 'Strategic Partners', 'slug' => 'strategic-partners'],
            ],
        ],
        /**
         * /soc/message-from-the-principal: from https://tenwekhospitalcollege.ac.ke/soc/message-from-the-principal/
         */
        'message_from_principal' => [
            'kicker' => 'Welcome to Tenwek Hospital College · School of Chaplaincy.',
            'motto' => 'Equip Chaplains for Wholistic Service',
            /** Set to a path under public/ (e.g. images/soc/principal.jpg) when available; empty shows a placeholder frame. */
            'principal_image' => env('TENWEK_SOC_PRINCIPAL_IMAGE'),
            'principal_image_alt' => env('TENWEK_SOC_PRINCIPAL_IMAGE_ALT', 'Principal, School of Chaplaincy'),
            'principal_placeholder_caption' => 'Photograph coming soon',
            'paragraphs' => [
                'I am glad that you have chosen to read these words of welcome. The School of Chaplaincy is a specialised training institution whose motto is to equip chaplains for wholistic service, and we are committed to training wholesome chaplains who will meet the spiritual needs of children of God serving in various capacities in our educational institutions, military formations, correctional establishments and during events outside the four corners of the church.',
                'With extensive experience spanning over 29 years, the School of Chaplaincy is equipped with resources and a wealth of experience that makes us a premier institution in Kenya and across East Africa, focused on training chaplains to serve.',
                'Our school is surrounded by various institutions including Tenwek Hospital, several educational institutions (primary and secondary schools, colleges, universities), correctional facilities, sports teams based at Silibwet and much more, creating a conducive learning and practice environment for our scholars.',
                'Embedded in deep Christian roots, students are taught and mentored by great scholars in the fields of learning with utmost dedication and commitment. The school prides itself on a competency-based curriculum aligned to the special training needs of a chaplain, informed by a comprehensive chaplaincy training needs analysis undertaken in institutions across the country. The diverse modes of curriculum delivery are an advantage anyone would want to maximise. International and local students challenged by distance are not left behind; they can enrol for interactive online studies.',
            ],
            'belief' => 'We strongly believe that God has called some to be chaplains, and they are burning with great passion, as expressed by the great apostle:',
            'scripture' => [
                'text' => 'To the Jew I became like a Jew, to win the Jews … To the weak I became weak, to win the weak. I have become all things to all people so that by all possible means some might be saved.',
                'reference' => '1 Corinthians 9:19-22',
            ],
            'invitation' => 'If these words resonate with you, or you know someone with such longings, the School of Chaplaincy is the place for you and for them. Come, and we will support your God-given calling to fruitfulness.',
        ],
        /**
         * /soc/board-and-management-team: from https://tenwekhospitalcollege.ac.ke/soc/board-and-management-team/
         */
        'board_and_management' => [
            'intro' => 'Tenwek Hospital College · School of Chaplaincy is a training subsidiary of Tenwek Hospital. The board that governs the school is therefore the same board that governs the hospital.',
            'photo_note' => 'Official portraits are displayed on each card as they become available.',
            'board_heading' => 'Board',
            /** Optional per person: `'image' => 'images/board/filename.jpg'` */
            'board' => [
                ['name' => 'Rev. John Kisotu', 'role' => 'Assistant Bishop, AGC Kenya', 'highlight' => false],
                ['name' => 'Rev. Dr. Robert Langat', 'role' => 'Bishop, AGC Kenya & Tenwek Hospital Board Chair', 'highlight' => true],
                ['name' => 'Daniel Kirui', 'role' => 'Board member', 'highlight' => false],
                ['name' => 'Isaac Kitur', 'role' => 'Board member', 'highlight' => false],
                ['name' => 'Collins Cheruiyot', 'role' => 'Board member', 'highlight' => false],
            ],
            'management_heading' => 'School management',
            'management' => [
                ['name' => 'Mr Benjamin Siele', 'role' => 'AGC Tenwek Hospital CEO & management chair', 'highlight' => true],
                ['name' => 'Mr Weldon Kigen', 'role' => 'Finance director', 'highlight' => false],
                ['name' => 'Rev. Elijah Bii', 'role' => 'Director of spiritual services & member', 'highlight' => false],
                ['name' => 'Mr Jackson Mosonik', 'role' => 'Principal, Tenwek Hospital College of Health Sciences & member', 'highlight' => false],
            ],
        ],
        /**
         * /soc/strategic-partners: from https://tenwekhospitalcollege.ac.ke/soc/strategic-partners/
         */
        'strategic_partners' => [
            'intro' => [
                'They say that a good friend knows all your best stories, but a best friend has lived them with you. We pride ourselves in having wonderful strategic partners who have walked with us in our quest to provide quality yet affordable healthcare.',
                'Important institutions we have partnered with include:',
            ],
            /** Optional per partner: `'image' => 'images/partners/agc.jpg'` (path under public/). */
            'partners' => [
                [
                    'name' => 'The Africa Gospel Church',
                    'abbr' => 'AGC',
                    'paragraphs' => [
                        'As the medical ministry of the Africa Gospel Church, Tenwek Hospital falls under the Compassion Department in the Health Outreach Programme section. We draw our Christian values and standard operating procedures from biblically inspired teaching, as instructed by the doctrines of the AGC.',
                    ],
                    'list_intro' => 'The Africa Gospel Church plays the following roles in the management of Tenwek Hospital:',
                    'bullets' => [
                        'Provides spiritual support and guidance',
                        'Nominates the board of trustees who oversee the running of the hospital',
                        'The bishop and assistant bishop of the AGC serve as board chair and assistant board chair respectively',
                        'Connects Tenwek with strategic partners and stakeholders who help propel the hospital towards growth',
                    ],
                    'closing' => 'We are proud to be affiliated with the Africa Gospel Church and look forward to a continued and sustained relationship.',
                ],
                [
                    'name' => 'Samaritan’s Purse',
                    'abbr' => 'SP',
                    'paragraphs' => [
                        'The mission of Samaritan’s Purse is to follow the example of Christ by helping those in need and proclaiming the hope of the gospel. Over the years, our partnership has been sustained through the grace and favour of God.',
                    ],
                    'list_intro' => 'Through Samaritan’s Purse, Tenwek Hospital benefits in the following ways:',
                    'bullets' => [
                        'Equipment and medical supplies support',
                        'Support for our chaplains’ Bible ministry',
                        'Connecting missionary doctors and surgeons who volunteer at Tenwek Hospital',
                        'Prayer and support for the hospital across various projects',
                    ],
                    'closing' => null,
                ],
                [
                    'name' => 'World Gospel Mission',
                    'abbr' => 'WGM',
                    'paragraphs' => [
                        'The history of Tenwek Hospital is incomplete without World Gospel Mission. The WGM team engages Christ-like disciples to transform the world.',
                    ],
                    'list_intro' => 'Over the years, World Gospel Mission has supported Tenwek Hospital in the following ways:',
                    'bullets' => [
                        'Representation on our board and management teams',
                        'Sending missionaries to serve in different capacities within the hospital',
                        'Raising funds on our behalf and supporting projects across the facility',
                        'Offering spiritual support and guidance',
                    ],
                    'closing' => null,
                ],
                [
                    'name' => 'Friends of Tenwek',
                    'abbr' => 'FoT',
                    'paragraphs' => [
                        'Established in 2009, Friends of Tenwek is dedicated to developing key relationships and resources that help the hospital fulfil its mission, often through capturing impactful stories about people and the mission at Tenwek Hospital.',
                    ],
                    'list_intro' => 'Through Friends of Tenwek, the hospital is able to:',
                    'bullets' => [
                        'Initiate hospital projects and programmes that are resource intensive',
                        'Sustain our chaplaincy programmes and the School of Chaplaincy',
                        'Establish and sustain community health programmes',
                        'Create impact in the lives of both staff and patients',
                        'Support development initiatives by the Tenwek Hospital College of Health Sciences',
                    ],
                    'closing' => null,
                ],
            ],
        ],
        /**
         * /soc/academic-programmes: mirrors https://tenwekhospitalcollege.ac.ke/soc/academic-programmes/
         * Course cards link to /soc/{slug} pages seeded in TenwekFoundationSeeder.
         */
        'academic_programmes' => [
            'kicker' => 'Our courses',
            'intro_paragraphs' => [
                'Chaplaincy Levels 5 and 6 qualifications consist of competencies that an individual must achieve to enable him/her to be certified as a chaplain. The two levels shall be examined by CDACC.',
                'A chaplain is a priest or a minister who can demonstrate competency in administering to the spiritual needs of persons from diverse faith backgrounds or no faith background, within a given institution, including but not limited to: hospitals, schools, colleges, universities, business/corporate settings, NGOs, sports organizations, airports, police departments, fire departments, military, correctional institutions, intelligence agencies, government bodies, etc.',
                'Therefore, a chaplain is a uniquely-trained person who can carry out these responsibilities. These responsibilities comprise 30 units of competency training in Chaplaincy Diploma level.',
            ],
            'groups' => [
                [
                    'heading' => 'Certificate and Diploma',
                    'description' => 'The current Certificate and Diploma in Chaplaincy will introduce these specialised areas of chaplaincy to be continued in other levels and beyond.',
                    'items' => [
                        [
                            'slug' => 'certificate-in-chaplaincy',
                            'title' => 'Certificate in Chaplaincy',
                            'badge' => 'Level 5',
                            'summary' => 'An introductory level (Level 5) for students with KCSE D (Plain) and above, a build-up to the Diploma.',
                        ],
                        [
                            'slug' => 'diploma-in-chaplaincy',
                            'title' => 'Diploma in Chaplaincy',
                            'badge' => 'Level 6',
                            'summary' => 'An advanced level (Level 6) to prepare chaplains to serve well: two years over six (6) trimesters, examined by CDACC.',
                        ],
                    ],
                ],
                [
                    'heading' => 'Specialised areas',
                    'description' => null,
                    'items' => [
                        [
                            'slug' => 'healthcare-chaplaincy',
                            'title' => 'Healthcare Chaplaincy',
                            'badge' => null,
                            'summary' => 'Serving in environments of sickness, pain, birth, and death, including hospital and hospice chaplaincy.',
                        ],
                        [
                            'slug' => 'military-chaplaincy',
                            'title' => 'Military Chaplaincy',
                            'badge' => null,
                            'summary' => 'Counseling and spiritual support for military personnel and families.',
                        ],
                        [
                            'slug' => 'educational-chaplaincy',
                            'title' => 'Educational Chaplaincy',
                            'badge' => null,
                            'summary' => 'Serving the spiritual needs of students, teachers, administrators, and support staff from primary school to higher education.',
                        ],
                        [
                            'slug' => 'police-chaplaincy',
                            'title' => 'Police Chaplaincy',
                            'badge' => null,
                            'summary' => 'Counseling and spiritual support for police officers, employees, and families.',
                        ],
                        [
                            'slug' => 'prison-chaplaincy',
                            'title' => 'Prison (correctional ministry) chaplaincy',
                            'badge' => null,
                            'summary' => 'Supporting inmates, officers, and their families with counseling and spiritual care in prisons, borstal institutions, rehabilitation schools, and probation departments.',
                        ],
                    ],
                ],
                [
                    'heading' => 'Future programmes',
                    'description' => null,
                    'items' => [
                        [
                            'slug' => 'future-chaplaincy-programmes',
                            'title' => 'Future programmes',
                            'badge' => null,
                            'summary' => 'The school envisions developing other areas of specialty training in chaplaincy alongside further study levels.',
                        ],
                    ],
                ],
            ],
        ],
        /**
         * /soc/fee: mirrors https://tenwekhospitalcollege.ac.ke/soc/fee/
         */
        'fee' => [
            'kicker' => 'Fees & finance',
            'intro' => 'Figures below are per trimester unless noted. The school does not accept cash on site; please use the bank transfer or M-Pesa pay bill details provided.',
            'structure' => [
                'title' => '2021 fee structure (per trimester)',
                'columns' => [
                    'diploma' => 'Diploma',
                    'certificate' => 'Certificate',
                ],
                'rows' => [
                    ['description' => 'Tuition fees', 'diploma' => 20_000, 'certificate' => 10_000],
                    ['description' => 'Registration', 'diploma' => 1_000, 'certificate' => 1_000],
                    ['description' => 'Activity', 'diploma' => 1_000, 'certificate' => 1_000],
                    ['description' => 'Library fee', 'diploma' => 1_500, 'certificate' => 1_500],
                    ['description' => 'Computer facilities fee', 'diploma' => 2_000, 'certificate' => 1_000],
                    ['description' => 'Medical (emergency)', 'diploma' => 1_000, 'certificate' => 1_000],
                    ['description' => 'Repairs, maintenance and improvement', 'diploma' => 1_500, 'certificate' => 1_500],
                    ['description' => 'Examination fees (internal)', 'diploma' => 1_000, 'certificate' => 500],
                ],
                'totals' => ['diploma' => 29_000, 'certificate' => 17_500],
            ],
            'one_time' => [
                'title' => 'One-time fees (new students)',
                'items' => [
                    ['label' => 'Application fees', 'amount' => 1_000],
                    ['label' => 'Student ID', 'amount' => 500],
                    ['label' => 'Caution money', 'amount' => 3_000],
                ],
            ],
            'optional' => [
                'title' => 'Optional fees',
                'body' => 'Boarding on campus is optional. If desired, a student pays Ksh 24,000 per trimester.',
            ],
            'payment_notice' => 'Payment of fees to the school: pay to the following account. No cash payment is accepted.',
            'bank' => [
                'account_name' => 'Tenwek Hospital School of Chaplaincy',
                'bank_name' => 'Kenya Commercial Bank',
                'branch' => 'Bomet',
                'account_number' => '1104955806',
                'bank_code' => '01181',
                'branch_code' => '038',
                'swift' => 'KCBLKENX',
                'currency' => 'KSH',
            ],
            'mpesa' => [
                'title' => 'M-Pesa',
                'paybill' => '522522',
                'account' => '1104955806',
                'confirmation_note' => 'After payment, SMS the message to 0716178653 for confirmation.',
            ],
        ],
        /**
         * /soc/admissions: mirrors https://tenwekhospitalcollege.ac.ke/soc/admissions/
         */
        'admissions' => [
            'kicker' => 'Admissions',
            'intro' => 'Explore programme materials below, then review entry requirements for the Certificate and Diploma. We are glad to walk with you through the process.',
            'contact_prompt' => 'Contact us for more details',
            'resources' => [
                [
                    'title' => 'Download school brochure',
                    'description' => 'Overview of the School of Chaplaincy, programmes, and campus life.',
                    'cta' => 'Browse downloads',
                    'route' => 'downloads.index',
                    'route_params' => ['school' => 'soc'],
                ],
                [
                    'title' => 'Application form',
                    'description' => 'Admission and registration forms for new applicants.',
                    'cta' => 'Get forms',
                    'route' => 'downloads.index',
                    'route_params' => ['school' => 'soc'],
                ],
                [
                    'title' => 'Online application',
                    'description' => 'Apply or continue your application through the online student portal.',
                    'cta' => 'Open portal',
                    'external' => true,
                    /** Falls back to soc_landing.top_bar.portal_url when null. */
                    'url' => env('TENWEK_SOC_ADMISSIONS_PORTAL_URL'),
                ],
            ],
            'requirements' => [
                'title' => 'Admission requirements',
                'certificate' => [
                    'title' => 'Certificate in Chaplaincy',
                    'body' => 'KCSE D (Plain) and above.',
                ],
                'diploma' => [
                    'title' => 'Diploma in Chaplaincy',
                    'items' => [
                        'Must have attained a pass in their previous qualification or Certificate in Chaplaincy (Level 5), or',
                        'KCSE mean grade of C- and above or its equivalent, or high school certificate (A-level) with a minimum of two principal passes and one subsidiary or its equivalent, or a distinction or credit from an accredited institution.',
                    ],
                ],
                'intake_note' => 'Admissions are done in January, May and September of each year.',
            ],
        ],
        /**
         * /soc/gallery: mirrors https://tenwekhospitalcollege.ac.ke/soc/gallery/
         * Replace or extend `items` with paths under public/ (e.g. images/soc/gallery/photo.jpg).
         */
        'gallery' => [
            'kicker' => 'Our gallery',
            'headline' => 'SOC life',
            'intro' => 'Worship, study, and service in the Tenwek Hospital College School of Chaplaincy, alongside the wider hospital and college community in Bomet.',
            'items' => [
                [
                    'src' => 'banner-a.jpg',
                    'alt' => 'Tenwek Hospital College: chaplaincy and campus context',
                    'caption' => 'Formation in the Tenwek hills',
                ],
                [
                    'src' => 'ctc.jpg',
                    'alt' => 'Tenwek Hospital: ministry alongside clinical care',
                    'caption' => 'Where chaplains walk with patients and staff',
                ],
                [
                    'src' => 'banner-nursing.jpg',
                    'alt' => 'Tenwek Hospital College: health sciences and shared mission',
                    'caption' => 'One college family, many vocations',
                ],
            ],
        ],
        /**
         * /soc/faqs: default copy aligned with https://tenwekhospitalcollege.ac.ke/soc/faqs/
         * (superseded by soc_faq_items when seeded or created in admin).
         */
        'faqs' => [
            'kicker' => 'FAQs',
            'intro' => 'Answers about chaplaincy formation, entry requirements, and where trained chaplains can serve.',
            'items' => [
                [
                    'question' => 'Is there a difference between a pastor and a chaplain?',
                    'lead' => 'Yes there is. Pastors and chaplains are trained differently and they serve in different ministries. Below are examples of key differences that distinguish the practice of the two:',
                    'comparison' => [
                        'left_header' => 'Pastors',
                        'right_header' => 'Chaplains',
                        'rows' => [
                            [
                                'left' => 'Ministry is church-based',
                                'right' => 'Ministry is beyond the church it is community/ institution-based. Chaplains are the bridge between secular and sacred',
                            ],
                            [
                                'left' => 'Serve members of same faith',
                                'right' => 'Serve people of all faiths',
                            ],
                            [
                                'left' => 'Members go to church where pastor is',
                                'right' => 'Chaplains go to where people are working, studying, healing, serving or imprisoned',
                            ],
                            [
                                'left' => 'Trained to teach and lead in specific denominational doctrines, beliefs',
                                'right' => 'Trained to be able to talk to and counsel people with variety of faith backgrounds. Chaplains function as supportive listeners more than verbal advisors',
                            ],
                            [
                                'left' => 'Shares his/her faith with members',
                                'right' => 'Meets the needs of client- does not share his/her own beliefs unless asked',
                            ],
                        ],
                    ],
                ],
                [
                    'question' => 'Why should I register for Certificate or Diploma in Chaplaincy?',
                    'paragraphs' => [
                        'Registering to take Certificate or Diploma in Chaplaincy studies exposes you to theory and practical work. The theory equips every chaplain with the right concepts to approach everyday life challenges while the practical work exposes our students to real-life scenarios enabling them to practice what they have learnt in class. This all-rounded training approach ensures that our students are qualified to serve in different settings.',
                    ],
                ],
                [
                    'question' => 'What is the minimum qualification required to join the programme?',
                    'certificate' => [
                        'title' => 'Certificate in chaplaincy',
                        'body' => 'KCSE D (Plain) and above.',
                    ],
                    'diploma' => [
                        'title' => 'Diploma in Chaplaincy admission requirements',
                        'items' => [
                            'Must have attained a pass in their previous qualification or Certificate in chaplaincy (Level 5) or',
                            'KCSE mean grade of C- and above or its equivalent, or high school certificate (A-level) with a minimum of two principal passes and one subsidiary or its equivalent or a distinction/credit from an accredited institution.',
                        ],
                    ],
                ],
                [
                    'question' => 'How long is the course?',
                    'lines' => [
                        'Certificate in Chaplaincy: 1 Year offered 3 trimesters.',
                        'Diploma in Chaplaincy: 2 Years of 6 trimesters.',
                    ],
                ],
                [
                    'question' => 'Where can I serve after completing my studies?',
                    'paragraphs' => [
                        'Chaplains have been trained to serve in a variety of settings including schools, universities, hospitals, in the correctional ministry, sports, in the military or police forces and in various institutions. We strongly believe that need versus the supply of trained chaplains is unmatched for the following reasons:',
                    ],
                    'bullets' => [
                        'In 2016, the Cabinet Secretary of Education announced that they are making it a requirement for all public high schools to have a trained chaplain serving the student population. This means that there is a huge demand for chaplains within the education sector',
                        'Institutions have recognized the important role played by Chaplains in Kenya. Between January and July 2019, over ten institutions advertised for vacancies in the chaplaincy field. Some of the notable institutions include; AIC Githumu Mission Hospital, PAC University, Nova Pioneer Schools and Brookhurst International.',
                    ],
                ],
            ],
        ],
        /** Slim strip above main SOC nav (matches legacy SOC bar: email, phone, portal). */
        'top_bar' => [
            'email' => env('TENWEK_SOC_EMAIL', 'soc@tenwekhosp.org'),
            'call_prefix' => 'Call:',
            /** Shown in the bar; use en dash before Ext as on the live site. */
            'call_display' => env('TENWEK_SOC_TOP_BAR_PHONE', '+254 728 091 900, Ext 1315/1334'),
            /** Dialable number for tel: (main line; extensions dial separately). */
            'call_tel' => env('TENWEK_SOC_TOP_BAR_TEL', '+254728091900'),
            'portal_label' => 'Online Portal',
            /** Student/LMS portal; falls back to SOC downloads if unset. */
            'portal_url' => env('TENWEK_SOC_PORTAL_URL', 'http://197.138.207.16:3036/osmis/'),
        ],
        'contact' => [
            'kicker' => 'Contact us',
            'location_lines' => [
                'Silibwet Township, Bomet Central, Kenya',
                'P.O. Box 39-20400, Bomet, Kenya',
                'Tenwek Hospital College · School of Chaplaincy',
            ],
            'phones' => [
                '+254 728 091 900, Ext. 1315 / 1334',
                '+254 202 045 542, Ext. 1315 / 1334',
            ],
            'email' => env('TENWEK_SOC_EMAIL', 'soc@tenwekhosp.org'),
            'office_hours_lines' => [],
            'social_links' => [],
        ],
    ],

    /**
     * College of Health Sciences landing (/cohs): section flow aligned with
     * https://tenwekhospitalcollege.ac.ke/cohs/
     */
    'cohs_landing' => [
        /** Navbar mark for /cohs (file under public/). */
        'logo' => env('TENWEK_COHS_LOGO', 'Tenwek-collge-logo.png'),
        'hero_image' => env('TENWEK_COHS_LANDING_HERO_IMAGE', 'images/image-1.jpg'),
        'welcome_image' => env('TENWEK_COHS_LANDING_WELCOME_IMAGE', 'images/image-2.jpg'),
        'map_embed_url' => env('TENWEK_COHS_MAP_EMBED_URL', 'https://maps.google.com/maps?q=-0.7792,35.3369&z=14&output=embed'),
        /**
         * /cohs/contact-us - brochure contact + apply facts
         */
        'contact_page' => [
            'hero_kicker' => 'College of Health Sciences',
            'headline' => 'Contact',
            'headline_accent' => 'us',
            'lead' => 'Send a note, call the office, or write to us in Bomet. We are glad to help with admissions, programmes, and general enquiries.',
            'intro' => 'Use the form to send us a message or email us at :email. Applications are received throughout the year, with March and September intakes. A non-refundable application fee must accompany application forms.',
            'email' => env('TENWEK_COHS_EMAIL', 'shs@tenwekhosp.org'),
            'office_title' => 'Tenwek Hospital College of Health Sciences',
            'phone_rows' => [
                [
                    'label' => 'Phone',
                    'numbers' => [
                        ['display' => '0736 568 177', 'tel' => '+254736568177'],
                        ['display' => '020 204 5542', 'tel' => '+254202045542'],
                        ['display' => '0728 091 900', 'tel' => '+254728091900'],
                    ],
                ],
            ],
            'address_lines' => ['P.O. Box 39-20400', 'Bomet, Kenya', 'About 5 km from Bomet Town'],
        ],
        'landing_seo' => [
            'title' => null,
            'description' => null,
            'keywords' => null,
            'canonical' => null,
            'og_title' => null,
            'og_description' => null,
            'og_image' => null,
            'robots' => null,
        ],
        'top_bar' => [
            'email' => env('TENWEK_COHS_EMAIL', 'shs@tenwekhosp.org'),
            'call_prefix' => 'Call:',
            'call_display' => env('TENWEK_COHS_TOP_BAR_PHONE', env('TENWEK_PUBLIC_PHONE', '+254 700 000 000')),
            'call_tel' => env('TENWEK_COHS_TOP_BAR_TEL', preg_replace('/[^\d+]/', '', env('TENWEK_PUBLIC_PHONE', '+254700000000'))),
            'portal_label' => 'Downloads & forms',
            'portal_url' => null,
        ],
        /** Off-campus / online application (Application → Off-campus link in header). */
        'off_campus_application_url' => env('TENWEK_COHS_OFF_CAMPUS_APPLICATION_URL', 'http://197.138.207.16:3036/online-application/'),
        /**
         * Primary COHS header (mirrors legacy /cohs/ menu).
         * Items with mega_id render a dropdown; others use slug for /cohs/{slug}.
         */
        'main_nav' => [
            ['label' => 'About Us', 'slug' => 'about-us'],
            [
                'label' => 'Courses',
                'mega_id' => 'cohs-courses',
                'children' => [
                    ['label' => 'Diploma in Nursing (KRCHN)', 'slug' => 'diploma-in-nursing'],
                    ['label' => 'Diploma in Clinical Medicine & Surgery', 'slug' => 'diploma-in-clinical-medicine'],
                    [
                        'label' => 'Higher Diploma in Cardiovascular Perfusion',
                        'route' => 'cohs.programme-application',
                        'route_params' => ['form' => 'hd-cardiovascular-perfusion'],
                    ],
                    [
                        'label' => 'HND Critical Care Nursing',
                        'route' => 'cohs.programme-application',
                        'route_params' => ['form' => 'critical-care-nursing'],
                    ],
                    [
                        'label' => 'HND Trauma & Emergency Nursing',
                        'route' => 'cohs.programme-application',
                        'route_params' => ['form' => 'hnd-trauma-emergency'],
                    ],
                    ['label' => 'BLS & ACLS short courses', 'slug' => 'application-forms'],
                ],
            ],
            ['label' => 'Social Life', 'slug' => 'social-life'],
            ['label' => 'Facilities', 'slug' => 'facilities'],
            [
                'label' => 'Application',
                'mega_id' => 'cohs-application',
                'children' => [
                    ['label' => 'On-campus link', 'route' => 'cohs.on-campus-application'],
                    [
                        'label' => 'Off-campus link',
                        /** For nav “active” state on /cohs/offcampus-link; link still uses external URL. */
                        'slug' => 'offcampus-link',
                        'external_config_key' => 'off_campus_application_url',
                        'open_new_tab' => true,
                    ],
                ],
            ],
            ['label' => 'Application forms', 'slug' => 'application-forms'],
            ['label' => 'Contact Us', 'slug' => 'contact-us'],
        ],
        'hero' => [
            'badge' => 'Training for Christ\'s Service',
            'eyebrow' => 'Tenwek Hospital College · College of Health Sciences',
            'headline' => 'College of Health Sciences',
            'subhead' => 'Qualified nurses since 1987: Christ-centred healthcare training, mentorship, and spiritual formation for nurses and clinical officers who serve with skill and compassion.',
            'primary_cta' => ['label' => 'View programmes', 'route' => 'schools.pages.show', 'params' => ['school' => 'cohs', 'pageSlug' => 'diploma-in-nursing']],
            'secondary_cta' => ['label' => 'Apply & downloads', 'hash' => 'programmes'],
        ],
        'welcome' => [
            'kicker' => 'Welcome',
            'title' => 'Welcome to the College of Health Sciences',
            'lead' => 'Established in 1987 as the Tenwek School of Nursing, the College of Health Sciences offers the best training in healthcare, mentorship, and matters of spirituality.',
            'paragraphs' => [
                'In 1999 the school graduated its first class of registered Community Health Nurses, and in 2022 its first class of registered Clinical Medicine and Surgery graduates.',
                'We incorporate classroom learning, clinical practice, and Christian service. The school is an affiliate of Africa Gospel Church and is equipped with nurses and doctors who mentor students for the field.',
            ],
        ],
        'programmes_band' => [
            'kicker' => 'Programmes',
            'title' => 'Training for Christ\'s Service',
            'intro' => 'Three-year diploma pathways, higher diplomas for practising clinicians and nurses, and life-saving short courses - all combining classroom learning, clinical practice, and Christian service.',
            'items' => [
                [
                    'title' => 'Diploma in Nursing (KRCHN)',
                    'summary' => 'A 3-year diploma forming midwives, general nurses, and community health nurses through classroom, clinical, and community training.',
                    'page_slug' => 'diploma-in-nursing',
                ],
                [
                    'title' => 'Diploma in Clinical Medicine & Surgery',
                    'summary' => 'A 3-year basic diploma preparing clinical officers for competent service in hospital and community settings.',
                    'page_slug' => 'diploma-in-clinical-medicine',
                ],
                [
                    'title' => 'Higher Diploma in Cardiovascular Perfusion',
                    'summary' => 'For clinicians with a diploma or degree in Clinical Medicine & Surgery, a valid practising licence, and at least two years\' experience. Advantage: anaesthesia or Critical Care Clinical Officer (ECCCO) with one year\'s experience.',
                    'apply_slug' => 'hd-cardiovascular-perfusion',
                    'cta_label' => 'Apply online',
                ],
                [
                    'title' => 'HND Critical Care Nursing',
                    'summary' => 'For nurses with a diploma or degree in nursing, a valid practising licence, and a minimum of two years\' working experience.',
                    'apply_slug' => 'critical-care-nursing',
                    'cta_label' => 'Apply online',
                ],
                [
                    'title' => 'HND Trauma & Emergency Nursing',
                    'summary' => 'Blended delivery for registered nurses (BScN, KRN, KRN/MHP, KRN/M, KRCHN) with at least one year of clinical experience and a valid nursing practice licence.',
                    'apply_slug' => 'hnd-trauma-emergency',
                    'cta_label' => 'Apply online',
                ],
                [
                    'title' => 'BLS & ACLS short courses',
                    'summary' => 'Basic Life Support (BLS) and Advanced Cardiovascular Life Support (ACLS) for healthcare professionals seeking essential emergency skills.',
                    'page_slug' => 'application-forms',
                    'cta_label' => 'Application forms',
                ],
            ],
        ],
        'testimonials' => [
            'kicker' => 'Student voices',
            'title' => 'We don\'t like to brag, but here is what students say',
            'items' => [
                [
                    'role' => 'Nursing student',
                    'quote' => 'Growing up, my health was not in good conditions and my parents and I had to make several trips to Tenwek Hospital. My love for the nursing career grew here and I knew I wanted to offer care to the sick in a compassionate manner similar to what I received. I am now in 1st year and truly the Tenwek College of Health Sciences is the place to be.',
                    'name' => 'Brillian Chebet',
                ],
                [
                    'role' => 'Nursing student',
                    'quote' => 'My parents are protective; I was born in Bomet and went to both primary and secondary school here. I knew I wanted a career in medicine. After KCSE I came to Tenwek College of Health Sciences. The years have flown by and I am now a finalist. I am a better person because of the training I have received here.',
                    'name' => 'Matthew Langat',
                ],
                [
                    'role' => 'Clinical medicine student',
                    'quote' => 'I have a unique story. I scored a B- in KCSE and later joined Moi University for environmental health. The course helped me realise my passion was in clinical medicine. With my family\'s support I pursued that calling. I am now in first year with no regrets. I cannot wait to begin my practice serving the sick.',
                    'name' => 'Joram',
                ],
            ],
        ],
        /**
         * /cohs/about-us, mirrored from https://tenwekhospitalcollege.ac.ke/cohs/about-us/
         */
        'about_us' => [
            'kicker' => 'About',
            /** Page hero (legacy H1). */
            'headline' => 'Training for Christ\'s Service',
            /** Shown beside “Our history” (file under public/). */
            'history_image' => env('TENWEK_COHS_ABOUT_HISTORY_IMAGE', 'banner-nursing.jpg'),
            'history_image_alt' => 'Nursing and clinical training at Tenwek Hospital College of Health Sciences',
            'history_heading' => 'Our history',
            'history_paragraphs' => [
                'Tenwek Hospital College - School of Health Sciences has qualified nurses since 1987. The school offers the best training in healthcare, mentorship, and matters of spirituality. In 1999 it graduated its first class of registered Community Health Nurses, and in 2022 its first class of registered Clinical Medicine and Surgery.',
                'We offer a 3-year diploma in Kenya Registered Community Health Nursing (KRCHN) and a 3-year diploma in Clinical Medicine and Surgery, plus Higher National Diploma in Trauma and Emergency Nursing (KRT&EN), Higher Diploma in Cardiovascular Perfusion, and Higher National Diploma in Critical Care Nursing. Training combines classroom learning, clinical practice, and Christian service. The school is an affiliate of Africa Gospel Church.',
            ],
            'vision' => [
                'title' => 'Vision',
                'text' => 'To train Christ-transformed and competent professionals serving humanity.',
            ],
            'mission' => [
                'title' => 'Mission',
                'text' => 'To prepare Christ-transformed professionals for competent service in a dynamic context through holistic quality training, research, and Bible-centred nourishment.',
            ],
            'motto' => [
                'title' => 'Motto',
                'text' => 'Training for Christ\'s Service',
            ],
            'board_section_heading' => 'Board and management team',
            'board_intro' => 'Tenwek Hospital College Health Sciences is a training subsidiary of Tenwek Hospital. The Board that governs the school is therefore the same Board that governs the hospital.',
            'board_heading' => 'Board',
            'board' => [
                [
                    'name' => 'Rev. Dr. Robert Langat',
                    'role' => 'Bishop AGC Kenya & Tenwek Hospital Board Chair',
                    'highlight' => true,
                ],
                [
                    'name' => 'Rev. John Kisotu',
                    'role' => 'Assistant Bishop AGC Kenya',
                ],
                [
                    'name' => 'Daniel Kirui',
                    'role' => 'Board member',
                ],
                [
                    'name' => 'Isaac Kitur',
                    'role' => 'Board member',
                ],
                [
                    'name' => 'Collins Cheruiyot',
                    'role' => 'Board member',
                ],
            ],
        ],
        /**
         * Programme detail pages: /cohs/diploma-in-nursing/, /cohs/diploma-in-clinical-medicine/, etc.
         */
        'programmes' => [
            'diploma_in_clinical_medicine' => [
                'kicker' => 'Diploma programme',
                'hero_image' => env('TENWEK_COHS_CLINICAL_HERO', 'banner-a.jpg'),
                'pillars' => [
                    ['label' => 'Accredited curriculum', 'description' => 'A structured three-year diploma aligned with regulatory expectations.'],
                    ['label' => 'Internship year', 'description' => 'One year of mandatory internship so graduates enter practice with confidence.'],
                    ['label' => 'Christ-like formation', 'description' => 'Training that pairs clinical skill with compassionate, servant-hearted care.'],
                ],
                'overview' => 'Tenwek Hospital College of Health Sciences offers a 3-year diploma in Clinical Medicine and Surgery. Graduates earn a basic diploma in Clinical Medicine and Surgery, prepared through classroom learning, clinical practice, and Christian service for competent care in hospitals and communities.',
                'admissions' => [
                    'heading' => 'Admission requirements',
                    'lead' => 'Those interested in pursuing a Diploma in Clinical Medicine & Surgery must meet the requirements below.',
                    'mean_grade' => 'KCSE mean grade of at least C Plain.',
                    'subject_rules' => [
                        'C in English or Kiswahili',
                        'C in Biology or Biological Sciences',
                        'C- (minus) in Chemistry',
                        'C- (minus) in either Mathematics, Physics, or Physical Sciences',
                    ],
                ],
            ],
            'diploma_in_nursing' => [
                'kicker' => 'Diploma programme',
                'pillars' => [
                    ['label' => 'Classroom learning', 'description' => 'Strong foundations in theory and professional practice.'],
                    ['label' => 'Clinical rounds', 'description' => 'Bedside training at Tenwek Hospital and partner sites.'],
                    ['label' => 'Community health', 'description' => 'Practical experience in communities around the college.'],
                ],
                'overview' => 'A 3-year diploma training programme for Basic Kenya Registered Community Health Nurse (KRCHN). Nursing graduates earn a diploma in nursing, having qualified as midwives, general nurses, and community health nurses - incorporating classroom learning, clinical practice, and Christian service.',
                'admissions' => [
                    'heading' => 'Admission requirements',
                    'lead' => 'Those interested in pursuing a Diploma in Nursing (KRCHN) must meet the requirements below.',
                    'mean_grade' => 'KCSE mean grade of at least C Plain.',
                    'subject_rules' => [
                        'C in English or Kiswahili',
                        'C in Biology or Biological Sciences',
                        'C- (minus) in Chemistry',
                        'C- (minus) in either Mathematics, Physics, or Physical Sciences',
                    ],
                ],
            ],
        ],
        /**
         * /cohs/social-life - brochure student life
         */
        'social_life' => [
            'kicker' => 'Student life',
            'headline_before' => 'Social',
            'headline_emphasis' => 'life',
            'pull_quote' => 'No man is an island!',
            'paragraphs' => [
                'The school has modern infrastructure and provides student accommodation in serene hostels that are conducive for study and relaxation. Students can participate in physical activities such as darts, table tennis, and volleyball, and they engage in Bible study and Christian Union fellowships.',
                'Students gain experience not only in classrooms and practical training but also in county hospital facilities, the national referral hospital, and the surrounding communities. Visit us to feel what studying at the College of Health Sciences is like.',
            ],
            'highlights' => [
                [
                    'title' => 'Hostels',
                    'description' => 'Modern, serene student accommodation supportive of study and rest.',
                ],
                [
                    'title' => 'Sports & recreation',
                    'description' => 'Darts, table tennis, volleyball, and space to recharge between clinical days.',
                ],
                [
                    'title' => 'Christian Union & Bible study',
                    'description' => 'Fellowship and shared faith that anchor student life.',
                ],
                [
                    'title' => 'Clinical placements',
                    'description' => 'Experience in county hospitals, national referral care, and community settings.',
                ],
            ],
            'hero_image' => env('TENWEK_COHS_SOCIAL_HERO', 'banner-nursing.jpg'),
        ],
        /**
         * /cohs/facilities - brochure campus facts
         */
        'facilities' => [
            'kicker' => 'Campus',
            'headline_before' => 'Our',
            'headline_emphasis' => 'facilities',
            'paragraphs' => [
                'The college building provides eight classrooms equipped with modern teaching aids, giving students a comfortable space and serene environment for learning.',
                'We have a modern library kitted with desktop computers and more than 6,000 books to support learning and research. Student accommodation is available in school hostels.',
                'The school has a modern skills laboratory equipped for practical learning. We are located in Bomet County, about 5 km from Bomet Town.',
            ],
            'highlights' => [
                [
                    'title' => 'Eight classrooms',
                    'description' => 'Modern teaching aids in a calm campus setting designed for focused learning.',
                ],
                [
                    'title' => 'Library & ICT',
                    'description' => 'Desktop computers and more than 6,000 books for research and revision.',
                ],
                [
                    'title' => 'Skills laboratory',
                    'description' => 'Modern equipment so students practise procedures before clinical placements.',
                ],
                [
                    'title' => 'Hostels & location',
                    'description' => 'On-campus hostels in Bomet County, about 5 km from Bomet Town.',
                ],
            ],
            'hero_image' => env('TENWEK_COHS_FACILITIES_HERO', 'banner-nursing.jpg'),
        ],
        'contact' => [
            'kicker' => 'Contact us',
            'location_lines' => [
                'Silibwet Township, Bomet Central, Kenya',
                'P.O. Box 39-20400, Bomet, Kenya',
                'About 5 km from Bomet Town',
                'Tenwek Hospital College · College of Health Sciences',
            ],
            'phones' => [
                env('TENWEK_PUBLIC_PHONE', '+254 700 000 000'),
            ],
            'email' => env('TENWEK_COHS_EMAIL', 'shs@tenwekhosp.org'),
            'office_hours_lines' => [
                'Applications are received throughout the year.',
                'Intakes: March and September.',
                'A non-refundable application fee must accompany application forms.',
            ],
            'social_links' => [],
        ],
    ],

    'footer' => [
        'accreditation' => array_filter([
            env('TENWEK_ACCREDITATION_1', 'Tenwek Hospital College is part of the Tenwek Hospital academic and ministry ecosystem.'),
            env('TENWEK_ACCREDITATION_2'),
        ]),
        'social_labels' => [
            'facebook' => 'Facebook',
            'instagram' => 'Instagram',
            'linkedin' => 'LinkedIn',
            'youtube' => 'YouTube',
            'x' => 'X',
        ],
    ],

    'navigation' => [
        /**
         * Main college header (non-school pages): keep this short. Other destinations
         * use CMS pages (`pages` with school_id null) and in-page content.
         */
        'primary' => [
            ['label' => 'Schools', 'route' => 'home', 'fragment' => 'schools'],
            ['label' => 'Downloads', 'route' => 'downloads.index'],
            ['label' => 'News & Events', 'route' => 'news.index'],
            ['label' => 'About', 'route' => 'pages.show', 'params' => ['slug' => 'about']],
        ],
    ],
];
