<?php

namespace App\Http\Requests;

use App\Support\CohsKenyaCounties;
use App\Support\CohsProgrammeApplicationCatalog;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CohsProgrammeApplicationStoreRequest extends FormRequest
{
    /**
     * @var array<string, mixed>|null
     */
    private ?array $formDefCache = null;

    public function authorize(): bool
    {
        return true;
    }

    /**
     * @return array<string, mixed>
     */
    public function formDef(): array
    {
        if ($this->formDefCache !== null) {
            return $this->formDefCache;
        }

        $def = CohsProgrammeApplicationCatalog::find((string) $this->route('form'));
        abort_if($def === null, 404);

        return $this->formDefCache = $def;
    }

    /**
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        $def = $this->formDef();
        $counties = CohsKenyaCounties::all();
        $file = ['file', 'max:5120', 'mimes:pdf,jpg,jpeg,png,webp'];
        $yesNo = ['required', Rule::in(['yes', 'no'])];

        $rules = [
            'fax' => ['prohibited'],
            'acknowledge_instructions' => ['accepted'],

            'full_name' => ['required', 'string', 'max:200'],
            'id_number' => ['required', 'string', 'max:64'],
            'postal_address' => ['required', 'string', 'max:500'],
            'mobile' => ['required', 'string', 'max:40'],
            'email' => ['required', 'email:rfc', 'max:255'],
            'county' => ['required', Rule::in($counties)],
            'nationality' => ['required', 'string', 'max:120'],
            'date_of_birth' => ['required', 'date', 'before:today', 'after:1900-01-01'],
            'age' => ['nullable', 'integer', 'min:15', 'max:99'],
            'sex' => ['required', Rule::in(['female', 'male'])],
            'marital_status' => ['required', Rule::in(['married', 'single', 'widowed', 'divorced'])],

            'spouse_name' => ['nullable', 'required_if:marital_status,married', 'string', 'max:200'],
            'children_count' => ['nullable', 'required_if:marital_status,married', 'integer', 'min:0', 'max:30'],
            'children_ages' => ['nullable', 'string', 'max:200'],
            'spouse_address' => ['nullable', 'string', 'max:500'],
            'spouse_occupation' => ['nullable', 'string', 'max:200'],

            'church_name' => ['required', 'string', 'max:200'],
            'denomination' => ['required', 'string', 'max:200'],

            'father_name' => ['required', 'string', 'max:200'],
            'father_living' => $yesNo,
            'father_occupation' => ['nullable', 'string', 'max:200'],
            'father_address' => ['nullable', 'string', 'max:500'],
            'father_mobile' => ['nullable', 'string', 'max:40'],

            'mother_name' => ['required', 'string', 'max:200'],
            'mother_living' => $yesNo,
            'mother_occupation' => ['nullable', 'string', 'max:200'],
            'mother_address' => ['nullable', 'string', 'max:500'],
            'mother_mobile' => ['nullable', 'string', 'max:40'],

            'guardian_relation' => ['nullable', 'string', 'max:120'],
            'guardian_name' => ['nullable', 'string', 'max:200'],
            'guardian_occupation' => ['nullable', 'string', 'max:200'],
            'guardian_address' => ['nullable', 'string', 'max:500'],
            'guardian_mobile' => ['nullable', 'string', 'max:40'],

            'ref_pastor_name' => ['required', 'string', 'max:200'],
            'ref_pastor_address' => ['required', 'string', 'max:500'],
            'ref_pastor_mobile' => ['required', 'string', 'max:40'],
            'ref_leader_name' => ['required', 'string', 'max:200'],
            'ref_leader_address' => ['required', 'string', 'max:500'],
            'ref_leader_mobile' => ['required', 'string', 'max:40'],
            'ref_friend_name' => ['required', 'string', 'max:200'],
            'ref_friend_address' => ['required', 'string', 'max:500'],
            'ref_friend_mobile' => ['required', 'string', 'max:40'],

            'essay_christian' => ['required', 'string', 'min:40', 'max:10000'],
            'essay_vocation' => ['required', 'string', 'min:40', 'max:10000'],
            'essay_witness' => ['required', 'string', 'min:40', 'max:10000'],
            'essay_family' => ['required', 'string', 'min:40', 'max:10000'],
            'essay_fees' => ['required', 'string', 'min:20', 'max:10000'],
            'essay_how_known' => ['required', 'string', 'min:10', 'max:5000'],

            'family_hereditary' => ['nullable', 'string', 'max:2000'],
            'health_explanations' => ['nullable', 'string', 'max:5000'],
            'health_medicines_info' => ['nullable', 'string', 'max:5000'],
            'health_other' => ['nullable', 'string', 'max:5000'],
            'hospital_admission_dates' => ['nullable', 'string', 'max:500'],
            'surgical_dates' => ['nullable', 'string', 'max:500'],

            'female_lmp' => ['nullable', 'string', 'max:80'],
            'female_period_sick' => ['nullable', 'string', 'max:200'],

            'kcse_results' => array_merge(['required'], $file),
            'leaving_certificate' => array_merge(['required'], $file),
            'national_id' => array_merge(['required'], $file),
            'proof_of_payment' => array_merge(['required'], $file),
            'marriage_certificate' => array_merge(['nullable', 'required_if:marital_status,married'], $file),
            'youngest_child_birth_certificate' => ['nullable', 'file', 'max:5120', 'mimes:pdf,jpg,jpeg,png,webp'],

            'practice_licence' => ['nullable', 'file', 'max:5120', 'mimes:pdf,jpg,jpeg,png,webp'],
            'diploma_or_degree' => ['nullable', 'file', 'max:5120', 'mimes:pdf,jpg,jpeg,png,webp'],
            'hd_anaesthesia_or_ecco' => ['nullable', 'file', 'max:5120', 'mimes:pdf,jpg,jpeg,png,webp'],

            'applicant_signature' => ['required', 'string', 'max:200'],
            'agree_declaration' => ['accepted'],
        ];

        foreach (CohsProgrammeApplicationCatalog::healthFlagKeys() as $key) {
            $rules['health.'.$key] = $yesNo;
        }

        if ($def['family'] === CohsProgrammeApplicationCatalog::FAMILY_PRE_SERVICE) {
            $rules['applied_before'] = $yesNo;
            $rules['applied_when'] = ['nullable', 'required_if:applied_before,yes', 'string', 'max:120'];
            $rules['came_to_interview'] = ['nullable', Rule::in(['yes', 'no'])];

            $rules['secondary_name'] = ['required', 'string', 'max:200'];
            $rules['secondary_address'] = ['required', 'string', 'max:500'];
            $rules['principal_name'] = ['nullable', 'string', 'max:200'];
            $rules['kcse_year'] = ['required', 'integer', 'min:1980', 'max:'.(int) date('Y')];
            $rules['kcse_aggregate'] = ['required', 'string', 'max:32'];
            $rules['kcse_english'] = ['required', 'string', 'max:16'];
            $rules['kcse_mathematics'] = ['required', 'string', 'max:16'];
            $rules['kcse_biology'] = ['required', 'string', 'max:16'];
            $rules['kcse_chemistry'] = ['nullable', 'string', 'max:16'];
            $rules['kcse_physics'] = ['nullable', 'string', 'max:16'];
            $rules['kcse_biological_sciences'] = ['nullable', 'string', 'max:16'];
            $rules['kcse_physical_sciences'] = ['nullable', 'string', 'max:16'];

            $rules['organizations'] = ['nullable', 'string', 'max:2000'];
            $rules['leadership_positions'] = ['nullable', 'string', 'max:2000'];
            $rules['post_kcse_courses'] = $yesNo;
            $rules['post_kcse_explain'] = ['nullable', 'required_if:post_kcse_courses,yes', 'string', 'max:2000'];
            $rules['work_reference'] = ['nullable', 'string', 'max:2000'];
            $rules['nursing_experience'] = ['nullable', 'string', 'max:2000'];
        } else {
            $rules['licence_number'] = ['required', 'string', 'max:80'];
            $rules['current_employer'] = ['required', 'string', 'max:200'];
            $rules['leadership_positions'] = ['nullable', 'string', 'max:2000'];

            $rules['secondary'] = ['required', 'array', 'min:1'];
            $rules['secondary.0.name'] = ['required', 'string', 'max:200'];
            $rules['secondary.0.address'] = ['nullable', 'string', 'max:500'];
            $rules['secondary.0.year'] = ['required', 'integer', 'min:1980', 'max:'.(int) date('Y')];
            $rules['secondary.0.mean_grade'] = ['required', 'string', 'max:32'];
            for ($i = 1; $i <= 2; $i++) {
                $rules['secondary.'.$i.'.name'] = ['nullable', 'string', 'max:200'];
                $rules['secondary.'.$i.'.address'] = ['nullable', 'string', 'max:500'];
                $rules['secondary.'.$i.'.year'] = ['nullable', 'required_with:secondary.'.$i.'.name', 'integer', 'min:1980', 'max:'.(int) date('Y')];
                $rules['secondary.'.$i.'.mean_grade'] = ['nullable', 'required_with:secondary.'.$i.'.name', 'string', 'max:32'];
            }

            $rules['colleges'] = ['required', 'array', 'min:1'];
            $rules['colleges.0.name'] = ['required', 'string', 'max:200'];
            $rules['colleges.0.address'] = ['nullable', 'string', 'max:500'];
            $rules['colleges.0.year'] = ['required', 'integer', 'min:1980', 'max:'.(int) date('Y')];
            $rules['colleges.0.qualification'] = ['required', 'string', 'max:200'];
            for ($i = 1; $i <= 2; $i++) {
                $rules['colleges.'.$i.'.name'] = ['nullable', 'string', 'max:200'];
                $rules['colleges.'.$i.'.address'] = ['nullable', 'string', 'max:500'];
                $rules['colleges.'.$i.'.year'] = ['nullable', 'required_with:colleges.'.$i.'.name', 'integer', 'min:1980', 'max:'.(int) date('Y')];
                $rules['colleges.'.$i.'.qualification'] = ['nullable', 'required_with:colleges.'.$i.'.name', 'string', 'max:200'];
            }

            $rules['former_employers'] = ['nullable', 'array'];
            for ($i = 0; $i <= 2; $i++) {
                $rules['former_employers.'.$i.'.name'] = ['nullable', 'string', 'max:200'];
                $rules['former_employers.'.$i.'.address'] = ['nullable', 'string', 'max:500'];
                $rules['former_employers.'.$i.'.duration'] = ['nullable', 'required_with:former_employers.'.$i.'.name', 'string', 'max:120'];
            }

            if ($def['requires_licence_file']) {
                $rules['practice_licence'] = array_merge(['required'], $file);
            }
            if ($def['requires_diploma_file']) {
                $rules['diploma_or_degree'] = array_merge(['required'], $file);
            }
            if ($def['requires_hd_anaesthesia_file']) {
                $rules['hd_anaesthesia_or_ecco'] = array_merge(['required'], $file);
            }
        }

        return $rules;
    }

    /**
     * @return array<string, string>
     */
    public function attributes(): array
    {
        return [
            'kcse_results' => 'KCSE results',
            'leaving_certificate' => 'school leaving certificate',
            'national_id' => 'national ID',
            'proof_of_payment' => 'proof of application fee',
            'practice_licence' => 'practice licence',
            'diploma_or_degree' => 'diploma or degree certificate',
            'hd_anaesthesia_or_ecco' => 'higher diploma in anaesthesia or ECCO',
            'secondary.0.name' => 'secondary school name',
            'colleges.0.name' => 'college or university name',
            'essay_christian' => 'Christian testimony essay',
            'essay_vocation' => 'vocation essay',
            'essay_witness' => 'Christian witness essay',
            'essay_family' => 'family and community essay',
            'essay_fees' => 'fees / sponsor essay',
            'essay_how_known' => 'how you heard about the college',
        ];
    }
}
