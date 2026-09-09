<?php

namespace App\Support\Cohs;

use App\Models\CohsBoardMember;
use App\Models\CohsLandingSection;
use App\Models\School;

final class CohsBoardMemberImporter
{
    /**
     * Copy board people from the About us CMS payload or config into the CRUD table.
     * No-op when members already exist (unless $force is true).
     *
     * @return int Number of members created
     */
    public static function importDefaults(School $cohs, bool $force = false): int
    {
        if ($cohs->slug !== 'cohs') {
            return 0;
        }

        if (! $force && CohsBoardMember::query()->where('school_id', $cohs->id)->exists()) {
            return 0;
        }

        $board = self::sourceRows($cohs);
        $created = 0;
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
            $created++;
        }

        if ($created > 0) {
            CohsLandingRepository::flushCache();
        }

        return $created;
    }

    /**
     * @return list<array<string, mixed>>
     */
    public static function sourceRows(School $cohs): array
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

    public static function defaultCount(School $cohs): int
    {
        return count(array_filter(
            self::sourceRows($cohs),
            static fn ($row) => is_array($row) && trim((string) ($row['name'] ?? '')) !== ''
        ));
    }
}
