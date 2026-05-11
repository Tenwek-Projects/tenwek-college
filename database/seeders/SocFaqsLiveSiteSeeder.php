<?php

namespace Database\Seeders;

use App\Models\School;
use App\Models\SocFaqItem;
use App\Models\SocLandingSection;
use App\Support\Soc\SocLandingRepository;
use Illuminate\Database\Seeder;

/**
 * FAQ accordions aligned with https://tenwekhospitalcollege.ac.ke/soc/faqs/
 * Stored in soc_faq_items so /soc/faqs uses DB-backed CRUD content on localhost and beyond.
 */
class SocFaqsLiveSiteSeeder extends Seeder
{
    public function run(): void
    {
        $soc = School::query()->where('slug', 'soc')->where('is_active', true)->first();
        if ($soc === null) {
            $this->command?->warn('SOC school not found; skipped SocFaqsLiveSiteSeeder.');

            return;
        }

        SocFaqItem::query()->where('school_id', $soc->id)->delete();

        foreach ($this->legacyItemsFromLiveSite() as $order => $legacy) {
            $question = $legacy['question'];
            unset($legacy['question']);
            SocFaqItem::query()->create([
                'school_id' => $soc->id,
                'sort_order' => $order,
                'question' => $question,
                'payload' => $legacy !== [] ? $legacy : null,
            ]);
        }

        SocLandingSection::query()->updateOrCreate(
            ['school_id' => $soc->id, 'section_key' => 'faqs'],
            ['payload' => [
                'kicker' => 'FAQs',
                'intro' => 'Answers about chaplaincy formation, entry requirements, and where trained chaplains can serve.',
            ]]
        );

        SocLandingRepository::flushCache();
    }

    /**
     * Legacy-shaped FAQ items (question + keys consumed by resources/views/schools/soc/faqs.blade.php).
     *
     * @return list<array<string, mixed>>
     */
    private function legacyItemsFromLiveSite(): array
    {
        return [
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
        ];
    }
}
