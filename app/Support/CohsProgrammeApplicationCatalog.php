<?php

namespace App\Support;

/**
 * Online wizards aligned with the six printable COHS application PDFs.
 *
 * @phpstan-type FormDef array{
 *     slug: string,
 *     download_slug: string,
 *     family: string,
 *     form_key: string,
 *     pdf_title: string,
 *     programme: string,
 *     vocation: string,
 *     duration: string,
 *     intake: string,
 *     deadline: ?string,
 *     fees_summary: string,
 *     eligibility: list<string>,
 *     required_documents: list<string>,
 *     essay_vocation: string,
 *     essay_witness: string,
 *     licence_label: ?string,
 *     requires_clinical_kcse: bool,
 *     requires_licence_file: bool,
 *     requires_diploma_file: bool,
 *     requires_hd_anaesthesia_file: bool,
 *     health_pregnancy_note: bool
 * }
 */
final class CohsProgrammeApplicationCatalog
{
    public const FAMILY_PRE_SERVICE = 'pre_service';

    public const FAMILY_POST_BASIC = 'post_basic';

    /**
     * @return list<string>
     */
    public static function slugs(): array
    {
        return array_column(self::definitions(), 'slug');
    }

    /**
     * @return FormDef|null
     */
    public static function find(string $slug): ?array
    {
        foreach (self::definitions() as $def) {
            if ($def['slug'] === $slug) {
                return $def;
            }
        }

        return null;
    }

    public static function applySlugForDownload(string $downloadSlug): ?string
    {
        foreach (self::definitions() as $def) {
            if ($def['download_slug'] === $downloadSlug) {
                return $def['slug'];
            }
        }

        return null;
    }

    /**
     * @return list<array{key: string, label: string}>
     */
    public static function healthFlags(): array
    {
        return [
            ['key' => 'depression', 'label' => 'Depression'],
            ['key' => 'nervous_breakdown', 'label' => 'Nervous breakdown'],
            ['key' => 'alcohol', 'label' => 'Use of alcohol'],
            ['key' => 'smokes', 'label' => 'Smokes'],
            ['key' => 'frequent_headaches', 'label' => 'Frequent headaches'],
            ['key' => 'frequent_colds', 'label' => 'Frequent colds'],
            ['key' => 'frequent_fever_malaria', 'label' => 'Frequent fever / malaria'],
            ['key' => 'ear_ache', 'label' => 'Ear ache / discharge'],
            ['key' => 'hearing_problems', 'label' => 'Hearing problems'],
            ['key' => 'painful_eyes', 'label' => 'Painful eyes'],
            ['key' => 'seeing_problems', 'label' => 'Seeing problems'],
            ['key' => 'epilepsy', 'label' => 'Epilepsy'],
            ['key' => 'fits', 'label' => 'Fits'],
            ['key' => 'fainting', 'label' => 'Fainting attacks'],
            ['key' => 'dizziness', 'label' => 'Dizziness'],
            ['key' => 'blackouts', 'label' => 'Blackouts'],
            ['key' => 'head_injuries', 'label' => 'Head injuries'],
            ['key' => 'tuberculosis', 'label' => 'Tuberculosis'],
            ['key' => 'diabetes', 'label' => 'Diabetes'],
            ['key' => 'kidney_disease', 'label' => 'Kidney disease'],
            ['key' => 'heart_disease', 'label' => 'Heart disease'],
            ['key' => 'chest_problems', 'label' => 'Chest problems'],
            ['key' => 'asthma', 'label' => 'Asthma'],
            ['key' => 'heartburn', 'label' => 'Heartburn / indigestion'],
            ['key' => 'hospital_admission', 'label' => 'Ever admitted to a hospital or health centre'],
            ['key' => 'surgical_operations', 'label' => 'Any surgical operations'],
            ['key' => 'frequent_medicines', 'label' => 'Frequent use of medicines'],
            ['key' => 'regular_medicine', 'label' => 'Regular use of medicine'],
        ];
    }

    /**
     * @return list<string>
     */
    public static function healthFlagKeys(): array
    {
        return array_column(self::healthFlags(), 'key');
    }

    /**
     * Shared payment copy from the 2025/2026 packs.
     */
    public static function paymentInstructions(): string
    {
        return 'Non-refundable application fee of KSh 1,500. No personal cheques or cash. Pay to KCB account 1118320271 or Lipa na M-PESA Paybill 522522, account 1118320271. Upload the bank slip or M-PESA message with your name.';
    }

    /**
     * @return list<FormDef>
     */
    public static function definitions(): array
    {
        $commonDocsPre = [
            'Completed application (all questions, including essays)',
            'Photocopy of KCSE results',
            'Photocopy of school leaving certificate',
            'Photocopy of national ID',
            'If married: marriage certificate and youngest child’s birth certificate (youngest child must be at least one year old before training begins)',
            'Proof of KSh 1,500 application fee',
        ];

        $faith = 'Applicants whose doctrine and Statement of Faith are consistent with those of Africa Gospel Church are accepted. Others may be considered individually. Applying does not guarantee admission; only shortlisted candidates are contacted for interview.';

        return [
            [
                'slug' => 'clinical-medicine',
                'download_slug' => 'cohs-application-form-clinical-rev-2025',
                'family' => self::FAMILY_PRE_SERVICE,
                'form_key' => 'cohs_apply_clinical_medicine',
                'pdf_title' => 'APPLICATION FORM-CLINICAL- REV 2025',
                'programme' => 'Diploma in Clinical Medicine and Surgery',
                'vocation' => 'Clinical Officer',
                'duration' => '3 years',
                'intake' => 'September 2025 class (as printed on the 2025 form)',
                'deadline' => null,
                'fees_summary' => 'About KSh 490,000 covering room, food, and transport to clinical experiences, plus textbook fee KSh 15,000 and uniform KSh 5,000. If accepted, a non-refundable deposit of KSh 85,000 and textbook fee of KSh 15,000 are due before college begins; the balance is paid in instalments.',
                'eligibility' => [
                    'KCSE aggregate C (plain).',
                    'Alternative A: English or Kiswahili C (plain); Biology C (plain); Chemistry C- (minus); Mathematics or Physics C- (minus).',
                    'Alternative B: English or Kiswahili C (plain); Biological Sciences C (plain); Physical Sciences C- (minus); Mathematics C- (minus).',
                    'Interview includes English and Mathematics entrance exams. You meet your own travel, food, and lodging costs for interview.',
                    $faith,
                ],
                'required_documents' => $commonDocsPre,
                'essay_vocation' => 'Write a paragraph on why you want to be a Clinical Officer.',
                'essay_witness' => 'Describe how a Clinical Officer can have a Christian witness.',
                'licence_label' => null,
                'requires_clinical_kcse' => true,
                'requires_licence_file' => false,
                'requires_diploma_file' => false,
                'requires_hd_anaesthesia_file' => false,
                'health_pregnancy_note' => false,
            ],
            [
                'slug' => 'krchn',
                'download_slug' => 'cohs-krchn-application-form',
                'family' => self::FAMILY_PRE_SERVICE,
                'form_key' => 'cohs_apply_krchn',
                'pdf_title' => 'KENYA REGISTERED COMMUNITY HEALTH NURSING (KRCHN)',
                'programme' => 'Kenya Registered Community Health Nursing (KRCHN)',
                'vocation' => 'nurse',
                'duration' => '3 years',
                'intake' => 'September 2026 class and March 2027',
                'deadline' => null,
                'fees_summary' => 'About KSh 570,100 covering tuition, accommodation, textbook fee, food, and transport to clinical experiences, plus about KSh 31,100 (uniform KSh 5,000, registration KSh 2,000, ID KSh 500 and other requirements), total about KSh 601,200. If accepted, a non-refundable deposit of KSh 85,000 and textbook fee of KSh 15,000 are due before college begins.',
                'eligibility' => [
                    'KCSE aggregate C (plain).',
                    'C (plain) in English or Kiswahili.',
                    'C (plain) in Biology (or Biological Sciences).',
                    'C- in any of Mathematics, Physics, Chemistry, or Physical Science.',
                    'Interview includes English and Mathematics entrance exams. You meet your own travel, food, and lodging costs for interview.',
                    $faith,
                ],
                'required_documents' => $commonDocsPre,
                'essay_vocation' => 'Write a paragraph on why you want to be a nurse.',
                'essay_witness' => 'Describe how a nurse can have a Christian witness.',
                'licence_label' => null,
                'requires_clinical_kcse' => false,
                'requires_licence_file' => false,
                'requires_diploma_file' => false,
                'requires_hd_anaesthesia_file' => false,
                'health_pregnancy_note' => false,
            ],
            [
                'slug' => 'critical-care-nursing',
                'download_slug' => 'cohs-application-form-critical-care-nursing-rev-2025',
                'family' => self::FAMILY_POST_BASIC,
                'form_key' => 'cohs_apply_critical_care_nursing',
                'pdf_title' => 'APPLICATION FORM -Critical care Nursing.Rev 2025',
                'programme' => 'Higher Diploma in Kenya Registered Critical Care Nursing',
                'vocation' => 'critical care nurse',
                'duration' => '2 years',
                'intake' => 'September 2025 class',
                'deadline' => 'Complete applications as soon as possible and not later than 15 May (as printed on the 2025 form).',
                'fees_summary' => 'About KSh 310,100 covering food (10 o’clock tea and lunch), tuition, and ACLS/BLS. Does not include accommodation, uniform, NCK indexing, or NCK final exam. If accepted, a non-refundable deposit of KSh 100,000 is due before training; the balance is paid in three instalments.',
                'eligibility' => [
                    'Valid Nursing Council of Kenya practice licence.',
                    'Diploma or degree in nursing.',
                    'Interview invitation is by SMS. You meet your own travel, food, and lodging costs for interview.',
                    $faith,
                ],
                'required_documents' => [
                    'Completed application (all questions, including essays)',
                    'Photocopy of KCSE results',
                    'Photocopy of secondary school leaving certificate',
                    'Photocopy of national ID',
                    'Photocopy of valid NCK nursing practice licence',
                    'Photocopy of diploma or degree in nursing',
                    'Proof of KSh 1,500 application fee',
                ],
                'essay_vocation' => 'Write a paragraph on why you want to be a critical care nurse.',
                'essay_witness' => 'Describe how a nurse can have a Christian witness.',
                'licence_label' => 'Nursing Council of Kenya licence number',
                'requires_clinical_kcse' => false,
                'requires_licence_file' => true,
                'requires_diploma_file' => true,
                'requires_hd_anaesthesia_file' => false,
                'health_pregnancy_note' => true,
            ],
            [
                'slug' => 'hnd-trauma-emergency',
                'download_slug' => 'cohs-application-form-hnd-trauma-emergency-2025',
                'family' => self::FAMILY_POST_BASIC,
                'form_key' => 'cohs_apply_hnd_trauma_emergency',
                'pdf_title' => 'APLICATION FORM-HND TRAUMA & EMERGENCY 2025',
                'programme' => 'Higher Diploma in Kenya Registered Trauma and Emergency Nursing',
                'vocation' => 'trauma and emergency nurse',
                'duration' => '2 years',
                'intake' => 'April 2025 class (as printed on the 2025 form)',
                'deadline' => 'Complete applications as soon as possible and not later than 28 February (as printed on the 2025 form).',
                'fees_summary' => 'About KSh 450,000 covering food (10 o’clock tea and lunch), tuition, and ACLS/BLS. Does not include accommodation, uniform, NCK indexing, or NCK final exam. If accepted, a non-refundable deposit of KSh 100,000 is due before training; the balance is paid in instalments.',
                'eligibility' => [
                    'Valid Nursing Council of Kenya practice licence.',
                    'Diploma or degree in nursing.',
                    'If married: youngest child must be at least one year old before training begins.',
                    'Interview invitation is by SMS. You meet your own travel, food, and lodging costs for interview.',
                    $faith,
                ],
                'required_documents' => [
                    'Completed application (all questions, including essays)',
                    'Photocopy of KCSE results',
                    'Photocopy of secondary school leaving certificate',
                    'Photocopy of national ID',
                    'Photocopy of valid NCK nursing practice licence',
                    'Photocopy of diploma or degree in nursing',
                    'If married: marriage certificate and youngest child’s birth certificate',
                    'Proof of KSh 1,500 application fee',
                ],
                'essay_vocation' => 'Write a paragraph on why you want to be a trauma and emergency nurse.',
                'essay_witness' => 'Describe how a nurse can have a Christian witness.',
                'licence_label' => 'Nursing Council of Kenya licence number',
                'requires_clinical_kcse' => false,
                'requires_licence_file' => true,
                'requires_diploma_file' => true,
                'requires_hd_anaesthesia_file' => false,
                'health_pregnancy_note' => true,
            ],
            [
                'slug' => 'hnd-cardiac-perfusion',
                'download_slug' => 'cohs-application-form-hnd-cardiac-perfusion-rev-2025',
                'family' => self::FAMILY_POST_BASIC,
                'form_key' => 'cohs_apply_hnd_cardiac_perfusion',
                'pdf_title' => 'APPLICATION FORM -HND Cardiac Perfusion.Rev 2025',
                'programme' => 'Higher Diploma in Cardiovascular Perfusion (Clinical Medicine)',
                'vocation' => 'Clinical Officer Cardiac Perfusionist',
                'duration' => '2 years',
                'intake' => 'September 2025 class',
                'deadline' => 'Complete applications as soon as possible and not later than 30 July (as printed on the 2025 form).',
                'fees_summary' => 'About KSh 700,000 covering food (10 o’clock tea and lunch), tuition, and ACLS/BLS. Does not include accommodation, uniform, COC indexing, or COC final exam. If accepted, a non-refundable deposit of KSh 250,000 is due before training; the balance is paid in instalments.',
                'eligibility' => [
                    'Valid Clinical Officers Council practice licence.',
                    'Higher Diploma in anaesthesia or Emergency Critical Care Officer (ECCO), and diploma or degree in Clinical Medicine and Surgery.',
                    'If married: youngest child must be at least one year old before training begins.',
                    'Only shortlisted candidates are contacted and invited for interview (SMS). You meet your own travel costs.',
                    $faith,
                ],
                'required_documents' => [
                    'Completed application (all questions, including essays)',
                    'Photocopy of KCSE results',
                    'Photocopy of secondary school leaving certificate',
                    'Photocopy of national ID',
                    'Photocopy of valid COC practice licence',
                    'Photocopy of Higher Diploma in anaesthesia or ECCO',
                    'Photocopy of diploma or degree in Clinical Medicine and Surgery',
                    'If married: marriage certificate and youngest child’s birth certificate',
                    'Proof of KSh 1,500 application fee',
                ],
                'essay_vocation' => 'Write a paragraph on why you want to be a Clinical Officer Cardiac Perfusionist.',
                'essay_witness' => 'Describe how a Clinical Officer can have a Christian witness.',
                'licence_label' => 'Clinical Officers Council licence number',
                'requires_clinical_kcse' => false,
                'requires_licence_file' => true,
                'requires_diploma_file' => true,
                'requires_hd_anaesthesia_file' => true,
                'health_pregnancy_note' => true,
            ],
            [
                'slug' => 'hd-cardiovascular-perfusion',
                'download_slug' => 'cohs-higher-diploma-cardiovascular-perfusion',
                'family' => self::FAMILY_POST_BASIC,
                'form_key' => 'cohs_apply_hd_cardiovascular_perfusion',
                'pdf_title' => 'HIGHER DIPLOMA IN CARDIOVASCULAR PERFUSION',
                'programme' => 'Higher Diploma in Cardiovascular Perfusion (Clinical Medicine)',
                'vocation' => 'Clinical Officer Cardiac Perfusionist',
                'duration' => '2 years',
                'intake' => 'September 2026 class',
                'deadline' => 'Complete applications as soon as possible and not later than 30 June (as printed on the Dec 2025 form).',
                'fees_summary' => 'About KSh 700,000 covering food (10 o’clock tea and lunch), tuition, and ACLS/BLS. Does not include accommodation, uniform, COC indexing, or COC final exam. If accepted, a non-refundable deposit of KSh 250,000 is due before training; the balance is paid in instalments.',
                'eligibility' => [
                    'Valid Clinical Officers Council practice licence.',
                    'Higher Diploma in anaesthesia or Emergency Critical Care Officer (ECCO), and diploma or degree in Clinical Medicine and Surgery.',
                    'If married: youngest child must be at least one year old before training begins.',
                    'Only shortlisted candidates are contacted and invited for interview (SMS). You meet your own travel costs.',
                    $faith,
                ],
                'required_documents' => [
                    'Completed application (all questions, including essays)',
                    'Photocopy of KCSE results',
                    'Photocopy of secondary school leaving certificate',
                    'Photocopy of national ID',
                    'Photocopy of valid COC practice licence',
                    'Photocopy of Higher Diploma in anaesthesia or ECCO',
                    'Photocopy of diploma or degree in Clinical Medicine and Surgery',
                    'If married: marriage certificate and youngest child’s birth certificate',
                    'Proof of KSh 1,500 application fee',
                ],
                'essay_vocation' => 'Write a paragraph on why you want to be a Clinical Officer Cardiac Perfusionist.',
                'essay_witness' => 'Describe how a Clinical Officer can have a Christian witness.',
                'licence_label' => 'Clinical Officers Council licence number',
                'requires_clinical_kcse' => false,
                'requires_licence_file' => true,
                'requires_diploma_file' => true,
                'requires_hd_anaesthesia_file' => true,
                'health_pregnancy_note' => true,
            ],
        ];
    }
}
