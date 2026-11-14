<?php

use App\Support\CohsApplicationFormDownloads;
use App\Models\Download;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

return new class extends Migration
{
    public function up(): void
    {
        if (! filled(config('filesystems.disks.s3.bucket'))) {
            // Local checkouts without S3 keep using their existing local copies.
            return;
        }

        $forms = CohsApplicationFormDownloads::definitions();
        $disk = Storage::disk('s3');

        foreach ($forms as $form) {
            $path = 'cohs/application-forms/'.$form['slug'].'.pdf';
            if (! $disk->exists($path)) {
                throw new \RuntimeException("Required COHS application form is missing from S3: {$path}");
            }
        }

        $schoolId = DB::table('schools')->where('slug', 'cohs')->value('id');
        if (! $schoolId) {
            return;
        }

        $categoryId = DB::table('download_categories')
            ->where('school_id', $schoolId)
            ->where('slug', 'admission-forms')
            ->value('id');

        foreach ($forms as $form) {
            $path = 'cohs/application-forms/'.$form['slug'].'.pdf';
            $filename = basename(parse_url($form['source_url'], PHP_URL_PATH) ?: $path);
            $description = match ($form['slug']) {
                'cohs-application-form-critical-care-nursing-rev-2025',
                'cohs-higher-diploma-cardiovascular-perfusion' => $form['title'].' Official application form. Please confirm current intake dates and fees with Admissions.',
                default => $form['title'].' Official application form from Tenwek Hospital College.',
            };

            Download::query()->updateOrCreate(
                ['slug' => $form['slug']],
                [
                    'school_id' => $schoolId,
                    'category_id' => $categoryId,
                    'title' => $form['title'],
                    'description' => $description,
                    'file_path' => $path,
                    'external_url' => null,
                    'original_filename' => $filename,
                    'mime' => 'application/pdf',
                    'size_bytes' => $disk->size($path),
                    'extension' => 'pdf',
                    'is_active' => true,
                    'published_at' => now(),
                    'seo_title' => $form['title'].' | COHS | '.config('tenwek.name'),
                    'seo_description' => 'Download '.$form['title'].' from Tenwek Hospital College, College of Health Sciences.',
                ]
            );
        }

        // The old list showed the same 2025 cardiac perfusion form twice.
        DB::table('downloads')
            ->where('school_id', $schoolId)
            ->where('slug', 'cohs-application-form-hnd-cardiac-perfusion-rev-2025')
            ->update(['is_active' => false, 'updated_at' => now()]);
    }

    public function down(): void
    {
        $schoolId = DB::table('schools')->where('slug', 'cohs')->value('id');
        if ($schoolId) {
            DB::table('downloads')
                ->where('school_id', $schoolId)
                ->where('slug', 'cohs-application-form-hnd-cardiac-perfusion-rev-2025')
                ->update(['is_active' => true, 'updated_at' => now()]);
        }
    }
};
