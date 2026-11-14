<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        $this->updateFacilities([
            'kicker' => 'Campus and facilities',
            'headline_before' => 'Facilities built for',
            'headline_emphasis' => 'learning',
            'lead' => 'Modern buildings in a calm setting at Tenwek, with a well-stocked library, a skills lab laid out like a ward, and accommodation and meals for every student.',
            'paragraphs' => [
                'The college building provides eight classrooms equipped with modern teaching aids, giving students a comfortable space and serene environment for learning.',
                'We have a modern library kitted with desktop computers and more than 6,000 books to support learning and research. Student accommodation is available in school hostels.',
                'The school has a modern skills laboratory laid out like a hospital ward for hands-on practice. Accommodation and meals are provided as part of the school fees. We are in Bomet County, about 5 km from Bomet Town and close to Tenwek Hospital for clinical rounds.',
            ],
            'stats' => [
                ['value' => '6,000+', 'label' => 'Books in the college library'],
                ['value' => '10+', 'label' => 'Desktop computers'],
                ['value' => '8', 'label' => 'Modern classrooms'],
                ['value' => 'Included', 'label' => 'Accommodation and meals'],
            ],
            'facility_cards' => [
                [
                    'title' => 'Skills lab',
                    'description' => 'Set up like a hospital ward for hands-on practice and demonstrations, helping students build confidence before working with patients.',
                    'image' => 'images/cohs/TWH261-1024x682.jpg',
                    'image_alt' => 'Two nursing students practising airway care on a manikin in the skills lab',
                ],
                [
                    'title' => 'Library and computers',
                    'description' => 'More than 6,000 books and desktop computers support research, study and revision.',
                    'image' => 'images/cohs/TWH424-1024x682.jpg',
                    'image_alt' => 'A smiling student in college uniform holding a book in the library',
                ],
                [
                    'title' => 'Classrooms',
                    'description' => 'Eight modern teaching spaces with learning aids in a calm, comfortable environment.',
                    'image' => 'images/cohs/TWH355-1024x682.jpg',
                    'image_alt' => 'Students discussing their work together in a classroom',
                ],
            ],
            'accommodation_heading' => 'Accommodation and meals',
            'accommodation_paragraphs' => [
                'Accommodation and meals are provided as part of the school fees, so students can focus on their studies and practical training.',
                'The college is at Tenwek, in the hills of Bomet County, close to Tenwek Hospital for clinical rounds and about 5 km from Bomet Town.',
            ],
            'hero_image' => 'tenwekoverhead.jpg',
            'hero_image_alt' => 'Aerial view of Tenwek and the surrounding hills',
        ]);
    }

    public function down(): void
    {
        $this->updateFacilities([
            'kicker' => 'Campus',
            'headline_before' => 'Our',
            'headline_emphasis' => 'facilities',
            'lead' => null,
            'stats' => null,
            'facility_cards' => null,
            'accommodation_heading' => null,
            'accommodation_paragraphs' => null,
            'paragraphs' => [
                'The college building provides eight classrooms equipped with modern teaching aids, giving students a comfortable space and serene environment for learning.',
                'We have a modern library kitted with desktop computers and more than 6,000 books to support learning and research. Student accommodation is available in school hostels.',
                'The school has a modern skills laboratory equipped for practical learning. We are located in Bomet County, about 5 km from Bomet Town.',
            ],
            'hero_image' => 'banner-nursing.jpg',
            'hero_image_alt' => null,
        ], removeNulls: true);
    }

    private function updateFacilities(array $changes, bool $removeNulls = false): void
    {
        $schoolId = DB::table('schools')->where('slug', 'cohs')->value('id');

        if (! $schoolId) {
            return;
        }

        $section = DB::table('cohs_landing_sections')
            ->where('school_id', $schoolId)
            ->where('section_key', 'facilities')
            ->first(['id', 'payload']);

        if (! $section) {
            return;
        }

        $payload = is_array($section->payload)
            ? $section->payload
            : (json_decode((string) $section->payload, true) ?: []);

        foreach ($changes as $key => $value) {
            if ($removeNulls && $value === null) {
                unset($payload[$key]);
            } else {
                $payload[$key] = $value;
            }
        }

        DB::table('cohs_landing_sections')->where('id', $section->id)->update([
            'payload' => json_encode($payload, JSON_UNESCAPED_UNICODE | JSON_THROW_ON_ERROR),
            'updated_at' => now(),
        ]);
    }
};
