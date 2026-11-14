<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    private const MAP_URL = 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3988.815841979077!2d36.8343166!3d-1.2844217999999998!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x182f119dc1c4872d%3A0x24104f8e63d8680e!2sTenwek%20Hospital%20College%20Of%20Health%20Sciences!5e0!3m2!1sen!2ske!4v1794657976999!5m2!1sen!2ske';
    private const PREVIOUS_MAP_URL = 'https://maps.google.com/maps?q=-0.7792,35.3369&z=14&output=embed';

    public function up(): void
    {
        $schoolId = DB::table('schools')->where('slug', 'cohs')->value('id');
        if (! $schoolId) {
            return;
        }

        $assets = DB::table('cohs_landing_sections')
            ->where('school_id', $schoolId)
            ->where('section_key', 'site_assets')
            ->first();
        $payload = $assets ? json_decode((string) $assets->payload, true) : [];
        $payload = is_array($payload) ? $payload : [];
        $payload['map_embed_url'] = self::MAP_URL;

        DB::table('cohs_landing_sections')->updateOrInsert(
            ['school_id' => $schoolId, 'section_key' => 'site_assets'],
            [
                'payload' => json_encode($payload, JSON_THROW_ON_ERROR),
                'created_at' => $assets->created_at ?? now(),
                'updated_at' => now(),
            ],
        );
    }

    public function down(): void
    {
        $schoolId = DB::table('schools')->where('slug', 'cohs')->value('id');
        if (! $schoolId) {
            return;
        }

        $assets = DB::table('cohs_landing_sections')
            ->where('school_id', $schoolId)
            ->where('section_key', 'site_assets')
            ->first();
        if (! $assets) {
            return;
        }

        $payload = json_decode((string) $assets->payload, true);
        if (! is_array($payload) || ($payload['map_embed_url'] ?? null) !== self::MAP_URL) {
            return;
        }

        $payload['map_embed_url'] = self::PREVIOUS_MAP_URL;
        DB::table('cohs_landing_sections')
            ->where('school_id', $schoolId)
            ->where('section_key', 'site_assets')
            ->update([
                'payload' => json_encode($payload, JSON_THROW_ON_ERROR),
                'updated_at' => now(),
            ]);
    }
};
