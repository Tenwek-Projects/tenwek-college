<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        $this->setAdditionalCourseLinksActive(false);
    }

    public function down(): void
    {
        $this->setAdditionalCourseLinksActive(true);
    }

    private function setAdditionalCourseLinksActive(bool $active): void
    {
        $schoolId = DB::table('schools')->where('slug', 'cohs')->value('id');

        if (! $schoolId) {
            return;
        }

        $coursesMenuIds = DB::table('cohs_nav_items')
            ->where('school_id', $schoolId)
            ->whereNull('parent_id')
            ->whereRaw('LOWER(label) = ?', ['courses'])
            ->pluck('id');

        if ($coursesMenuIds->isEmpty()) {
            return;
        }

        DB::table('cohs_nav_items')
            ->whereIn('parent_id', $coursesMenuIds)
            ->where(function ($query) {
                $query->whereNull('page_slug')
                    ->orWhereNotIn('page_slug', ['diploma-in-nursing', 'diploma-in-clinical-medicine']);
            })
            ->update(['is_active' => $active, 'updated_at' => now()]);
    }
};
