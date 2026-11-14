<?php

namespace App\Support;

/**
 * Current COHS printable application forms listed on the official site.
 *
 * @phpstan-type FormDef array{slug: string, title: string, source_url: string}
 */
final class CohsApplicationFormDownloads
{
    /**
     * @return list<FormDef>
     */
    public static function definitions(): array
    {
        return [
            [
                'slug' => 'cohs-krchn-application-form',
                'title' => 'Diploma in Nursing (KRCHN) application form',
                'source_url' => 'https://tenwekhospitalcollege.ac.ke/cohs/wp-content/uploads/2026/10/APPLICATION-FORM-NURSING-rev-2025.pdf',
            ],
            [
                'slug' => 'cohs-application-form-clinical-rev-2025',
                'title' => 'Diploma in Clinical Medicine & Surgery application form',
                'source_url' => 'https://tenwekhospitalcollege.ac.ke/cohs/wp-content/uploads/2026/10/APPLICATION-FORM-CLINICAL-REV-2025.pdf',
            ],
            [
                'slug' => 'cohs-application-form-critical-care-nursing-rev-2025',
                'title' => 'Higher Diploma in Critical Care Nursing application form',
                'source_url' => 'https://tenwekhospitalcollege.ac.ke/cohs/wp-content/uploads/2026/10/APPLICATION-FORM-Critical-care-Nursing.Rev-2025-doc.pdf',
            ],
            [
                'slug' => 'cohs-higher-diploma-cardiovascular-perfusion',
                'title' => 'Higher Diploma in Cardiac Perfusion application form',
                'source_url' => 'https://tenwekhospitalcollege.ac.ke/cohs/wp-content/uploads/2026/10/APPLICATION-FORM-HND-Cardiac-Perfusion.Rev-2025-doc.pdf',
            ],
            [
                'slug' => 'cohs-application-form-hnd-trauma-emergency-2025',
                'title' => 'Higher Diploma in Trauma & Emergency Nursing application form',
                'source_url' => 'https://tenwekhospitalcollege.ac.ke/cohs/wp-content/uploads/2026/10/APPLICATION-FORM-HND-Trauma-and-Emergency.pdf',
            ],
        ];
    }

    /**
     * @return list<string>
     */
    public static function orderedSlugs(): array
    {
        return array_column(self::definitions(), 'slug');
    }
}
