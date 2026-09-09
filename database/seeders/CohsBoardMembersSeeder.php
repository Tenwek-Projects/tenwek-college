<?php

namespace Database\Seeders;

use App\Models\School;
use App\Support\Cohs\CohsBoardMemberImporter;
use Illuminate\Database\Seeder;

class CohsBoardMembersSeeder extends Seeder
{
    public function run(): void
    {
        $cohs = School::query()->where('slug', 'cohs')->first();
        if ($cohs === null) {
            return;
        }

        CohsBoardMemberImporter::importDefaults($cohs);
    }
}
