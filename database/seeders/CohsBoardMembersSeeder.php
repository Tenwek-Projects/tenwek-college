<?php

namespace Database\Seeders;

use App\Models\CohsBoardMember;
use App\Models\CohsLandingSection;
use App\Models\School;
use Illuminate\Database\Seeder;

class CohsBoardMembersSeeder extends Seeder
{
    public function run(): void
    {
        $cohs = School::query()->where('slug', 'cohs')->first();
        if ($cohs === null) {
            return;
        }

        if (CohsBoardMember::query()->where('school_id', $cohs->id)->exists()) {
            return;
        }

        $board = $this->boardSource($cohs);
        $order = 0;
        foreach ($board as $row) {
            if (! is_array($row)) {
                continue;
            }
            $name = trim((string) ($row['name'] ?? ''));
            if ($name === '') {
                continue;
            }
            CohsBoardMember::query()->create([
                'school_id' => $cohs->id,
                'name' => $name,
                'role_title' => (string) ($row['role'] ?? 'Board member'),
                'bio' => isset($row['bio']) && is_string($row['bio']) ? $row['bio'] : null,
                'image_path' => isset($row['image']) && is_string($row['image']) ? $row['image'] : null,
                'highlight' => (bool) ($row['highlight'] ?? false),
                'sort_order' => $order++,
                'is_published' => true,
            ]);
        }
    }

    /**
     * @return list<array<string, mixed>>
     */
    private function boardSource(School $cohs): array
    {
        $section = CohsLandingSection::query()
            ->where('school_id', $cohs->id)
            ->where('section_key', 'about_us')
            ->first();
        $payloadBoard = is_array($section?->payload['board'] ?? null) ? $section->payload['board'] : [];
        if ($payloadBoard !== []) {
            return array_values($payloadBoard);
        }

        $configBoard = config('tenwek.cohs_landing.about_us.board', []);

        return is_array($configBoard) ? array_values($configBoard) : [];
    }
}
