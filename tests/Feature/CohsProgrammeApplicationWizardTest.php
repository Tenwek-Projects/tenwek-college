<?php

namespace Tests\Feature;

use App\Mail\CohsProgrammeApplicationMail;
use App\Models\FormSubmission;
use App\Models\School;
use App\Support\CohsProgrammeApplicationCatalog;
use Database\Seeders\TenwekFoundationSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class CohsProgrammeApplicationWizardTest extends TestCase
{
    use RefreshDatabase;

    private function essay(string $extra = ''): string
    {
        return 'This is a sufficiently long essay answer for validation purposes. '.$extra;
    }

    /**
     * @return array<string, string>
     */
    private function healthPayload(): array
    {
        $out = [];
        foreach (CohsProgrammeApplicationCatalog::healthFlagKeys() as $key) {
            $out['health'][$key] = 'no';
        }

        return $out;
    }

    /**
     * @return array<string, mixed>
     */
    private function sharedBase(): array
    {
        return array_merge([
            'acknowledge_instructions' => '1',
            'full_name' => 'Jane Wanjiku Otieno',
            'id_number' => '12345678',
            'postal_address' => 'P.O. Box 39, Bomet',
            'mobile' => '+254700000001',
            'email' => 'jane@example.com',
            'county' => 'Bomet',
            'nationality' => 'Kenyan',
            'date_of_birth' => '2000-04-12',
            'age' => 26,
            'sex' => 'female',
            'marital_status' => 'single',
            'church_name' => 'Africa Gospel Church Tenwek',
            'denomination' => 'Africa Gospel Church',
            'father_name' => 'John Otieno',
            'father_living' => 'yes',
            'mother_name' => 'Mary Otieno',
            'mother_living' => 'yes',
            'ref_pastor_name' => 'Pastor Kip',
            'ref_pastor_address' => 'Bomet',
            'ref_pastor_mobile' => '+254711000001',
            'ref_leader_name' => 'Elder Chebet',
            'ref_leader_address' => 'Bomet',
            'ref_leader_mobile' => '+254711000002',
            'ref_friend_name' => 'Ann Chepkemoi',
            'ref_friend_address' => 'Kericho',
            'ref_friend_mobile' => '+254711000003',
            'essay_christian' => $this->essay('Christian testimony.'),
            'essay_vocation' => $this->essay('Vocation.'),
            'essay_witness' => $this->essay('Witness.'),
            'essay_family' => $this->essay('Family and community.'),
            'essay_fees' => 'My parents will help pay fees from farming income.',
            'essay_how_known' => 'Through the college website.',
            'applicant_signature' => 'Jane Wanjiku Otieno',
            'agree_declaration' => '1',
            'kcse_results' => UploadedFile::fake()->create('kcse.pdf', 100, 'application/pdf'),
            'leaving_certificate' => UploadedFile::fake()->create('leaving.pdf', 100, 'application/pdf'),
            'national_id' => UploadedFile::fake()->create('id.pdf', 100, 'application/pdf'),
            'proof_of_payment' => UploadedFile::fake()->create('pay.pdf', 100, 'application/pdf'),
        ], $this->healthPayload());
    }

    public function test_unknown_form_slug_returns_404(): void
    {
        $this->seed(TenwekFoundationSeeder::class);
        School::query()->where('slug', 'cohs')->update(['is_active' => true]);

        $this->get(route('cohs.programme-application', 'not-a-real-form'))->assertNotFound();
    }

    public function test_krchn_wizard_page_renders(): void
    {
        $this->seed(TenwekFoundationSeeder::class);
        School::query()->where('slug', 'cohs')->update(['is_active' => true]);

        $response = $this->get(route('cohs.programme-application', 'krchn'));

        $response->assertOk();
        $response->assertSee('Kenya Registered Community Health Nursing', false);
        $response->assertSee('Before you apply', false);
        $response->assertSee('Submit application', false);
    }

    public function test_application_forms_page_links_to_apply_online(): void
    {
        $this->seed(TenwekFoundationSeeder::class);

        $response = $this->get(route('schools.pages.show', ['school' => 'cohs', 'pageSlug' => 'application-forms']));

        $response->assertOk();
        $response->assertSee('Apply online', false);
        $response->assertSee(route('cohs.programme-application', 'krchn'), false);
        $response->assertSee(route('cohs.programme-application', 'clinical-medicine'), false);
    }

    public function test_krchn_stores_submission_with_uploads(): void
    {
        $this->seed(TenwekFoundationSeeder::class);
        School::query()->where('slug', 'cohs')->update(['is_active' => true]);
        Storage::fake('local');
        Mail::fake();

        $payload = array_merge($this->sharedBase(), [
            'applied_before' => 'no',
            'secondary_name' => 'Tenwek High School',
            'secondary_address' => 'Bomet',
            'kcse_year' => 2018,
            'kcse_aggregate' => 'C+',
            'kcse_english' => 'C+',
            'kcse_mathematics' => 'C',
            'kcse_biology' => 'C+',
            'post_kcse_courses' => 'no',
        ]);

        $response = $this->post(route('cohs.programme-application.store', 'krchn'), $this->withMathChallenge($payload));

        $response->assertRedirect(route('cohs.programme-application', 'krchn'));
        $response->assertSessionHas('status');

        $this->assertDatabaseHas('form_submissions', [
            'form_key' => 'cohs_apply_krchn',
        ]);

        $submission = FormSubmission::query()->where('form_key', 'cohs_apply_krchn')->first();
        $this->assertNotNull($submission);
        $this->assertSame('Jane Wanjiku Otieno', $submission->payload['full_name'] ?? null);
        $this->assertNotEmpty($submission->payload['kcse_results_path'] ?? null);
        Storage::disk('local')->assertExists($submission->payload['kcse_results_path']);
        Mail::assertSent(CohsProgrammeApplicationMail::class, function (CohsProgrammeApplicationMail $mail) {
            return $mail->hasTo('collegeofhealthsciences@tenwekhosp.org');
        });
    }

    public function test_critical_care_stores_post_basic_submission(): void
    {
        $this->seed(TenwekFoundationSeeder::class);
        School::query()->where('slug', 'cohs')->update(['is_active' => true]);
        Storage::fake('local');
        Mail::fake();

        $payload = array_merge($this->sharedBase(), [
            'licence_number' => 'NCK-12345',
            'current_employer' => 'Tenwek Hospital',
            'secondary' => [
                ['name' => 'Kaplong Girls', 'address' => 'Sotik', 'year' => 2012, 'mean_grade' => 'B'],
            ],
            'colleges' => [
                ['name' => 'KMTC', 'address' => 'Nairobi', 'year' => 2016, 'qualification' => 'KRCHN Diploma'],
            ],
            'practice_licence' => UploadedFile::fake()->create('licence.pdf', 100, 'application/pdf'),
            'diploma_or_degree' => UploadedFile::fake()->create('diploma.pdf', 100, 'application/pdf'),
        ]);

        $response = $this->post(route('cohs.programme-application.store', 'critical-care-nursing'), $this->withMathChallenge($payload));

        $response->assertRedirect(route('cohs.programme-application', 'critical-care-nursing'));
        $response->assertSessionHas('status');

        $submission = FormSubmission::query()->where('form_key', 'cohs_apply_critical_care_nursing')->first();
        $this->assertNotNull($submission);
        $this->assertSame('NCK-12345', $submission->payload['licence_number'] ?? null);
        $this->assertNotEmpty($submission->payload['practice_licence_path'] ?? null);
        Storage::disk('local')->assertExists($submission->payload['practice_licence_path']);
        Mail::assertSent(CohsProgrammeApplicationMail::class);
    }

    public function test_honeypot_rejects_submission(): void
    {
        $this->seed(TenwekFoundationSeeder::class);
        School::query()->where('slug', 'cohs')->update(['is_active' => true]);

        $payload = array_merge($this->sharedBase(), [
            'fax' => 'bot-filled',
            'applied_before' => 'no',
            'secondary_name' => 'School',
            'secondary_address' => 'Bomet',
            'kcse_year' => 2018,
            'kcse_aggregate' => 'C',
            'kcse_english' => 'C',
            'kcse_mathematics' => 'C',
            'kcse_biology' => 'C',
            'post_kcse_courses' => 'no',
        ]);

        $response = $this->from(route('cohs.programme-application', 'krchn'))
            ->post(route('cohs.programme-application.store', 'krchn'), $this->withMathChallenge($payload));

        $response->assertSessionHasErrors('fax');
        $this->assertDatabaseMissing('form_submissions', ['form_key' => 'cohs_apply_krchn']);
    }
}
