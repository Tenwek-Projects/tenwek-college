<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        $this->updateSocialLife([
            'headline_before' => 'Life beyond the',
            'headline_emphasis' => 'classroom',
            'lead' => 'No one trains alone. Our students learn, play, worship and serve together, building friendships and a living relationship with Christ.',
            'pull_quote' => 'No man is an island!',
            'paragraphs' => [
                'Our students learn, play, worship and serve together, building friendships and a living relationship with Christ.',
                'From comfortable student hostels and recreation to Bible study, clinical placements, and community volunteering, life at Tenwek extends well beyond the classroom.',
            ],
            'activities_intro' => 'The college provides facilities and spaces for students to interact, grow and have fun.',
            'highlights' => [
                ['title' => 'Sport', 'description' => 'Football and table tennis to stay active and unwind between classes and ward shifts.'],
                ['title' => 'Christian Union', 'description' => 'Fellowship, worship and Christian Union challenges that help you grow in faith.'],
                ['title' => 'Outdoor trips', 'description' => 'Trips beyond campus to explore, relax and build friendships.'],
                ['title' => 'Community volunteering', 'description' => 'Serving the communities around Tenwek, putting compassionate care into practice.'],
            ],
            'community_heading' => 'A community, not just a college',
            'community_paragraphs' => [
                'Studying at Tenwek means joining a close community of classmates, tutors and hospital staff who share a calling to care in Christ’s name.',
                'You’ll learn together, worship together and serve together.',
            ],
            'hero_image' => 'images/cohs/TWH163-1024x701.jpg',
            'community_image' => 'images/cohs/TWH330-1024x682.jpg',
        ]);
    }

    public function down(): void
    {
        $this->updateSocialLife([
            'headline_before' => 'Social',
            'headline_emphasis' => 'life',
            'lead' => null,
            'pull_quote' => 'No man is an island!',
            'paragraphs' => [
                'The school has modern infrastructure and provides student accommodation in serene hostels that are conducive for study and relaxation. Students can participate in physical activities such as darts, table tennis, and volleyball, and they engage in Bible study and Christian Union fellowships.',
                'Students gain experience not only in classrooms and practical training but also in county hospital facilities, the national referral hospital, and the surrounding communities. Visit us to feel what studying at the College of Health Sciences is like.',
            ],
            'activities_intro' => null,
            'highlights' => [
                ['title' => 'Hostels', 'description' => 'Modern, serene student accommodation supportive of study and rest.'],
                ['title' => 'Sports & recreation', 'description' => 'Darts, table tennis, volleyball, and space to recharge between clinical days.'],
                ['title' => 'Christian Union & Bible study', 'description' => 'Fellowship and shared faith that anchor student life.'],
                ['title' => 'Clinical placements', 'description' => 'Experience in county hospitals, national referral care, and community settings.'],
            ],
            'community_heading' => null,
            'community_paragraphs' => null,
            'hero_image' => 'banner-nursing.jpg',
            'community_image' => null,
        ], removeNulls: true);
    }

    private function updateSocialLife(array $changes, bool $removeNulls = false): void
    {
        $schoolId = DB::table('schools')->where('slug', 'cohs')->value('id');

        if (! $schoolId) {
            return;
        }

        $section = DB::table('cohs_landing_sections')
            ->where('school_id', $schoolId)
            ->where('section_key', 'social_life')
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
