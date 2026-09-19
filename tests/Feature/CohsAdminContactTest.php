<?php

namespace Tests\Feature;

use App\Models\CohsLandingSection;
use App\Models\User;
use App\Support\Cohs\CohsLandingRepository;
use Database\Seeders\TenwekFoundationSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CohsAdminContactTest extends TestCase
{
    use RefreshDatabase;

    public function test_cohs_admin_can_update_all_contact_surfaces_from_one_form(): void
    {
        $this->seed(TenwekFoundationSeeder::class);
        $user = User::query()->where('email', 'cohs.admin@tenwekhospitalcollege.ac.ke')->firstOrFail();
        $cohs = \App\Models\School::query()->where('slug', 'cohs')->firstOrFail();

        $this->actingAs($user)
            ->get(route('admin.cohs.contact.edit'))
            ->assertOk()
            ->assertSee('Shared contact details', false)
            ->assertSee('Header top bar', false)
            ->assertSee('Landing contact band', false)
            ->assertSee('Contact page', false);

        $payload = [
            'email' => 'shs-updated@tenwekhosp.org',
            'phone_numbers' => "0711 111 111\n0722 222 222",
            'phone_row_label' => 'Phone',
            'call_prefix' => 'Call:',
            'call_display' => '0711 111 111',
            'call_tel' => '+254711111111',
            'landing_kicker' => 'Contact us',
            'landing_location_lines' => "Line A\nLine B",
            'office_hours_lines' => "Year-round applications.\nMarch & September intakes.",
            'social_label' => ['Facebook', ''],
            'social_url' => ['https://facebook.com/tenwek', ''],
            'hero_kicker' => 'College of Health Sciences',
            'headline' => 'Contact',
            'headline_accent' => 'us',
            'lead' => 'Reach the office.',
            'intro' => 'Email us at :email for admissions help.',
            'office_title' => 'Tenwek Hospital College of Health Sciences',
            'address_lines' => "P.O. Box 39-20400\nBomet, Kenya",
            'map_embed_url' => 'https://maps.google.com/maps?q=-0.7792,35.3369&z=14&output=embed',
        ];

        $this->actingAs($user)
            ->put(route('admin.cohs.contact.update'), $payload)
            ->assertRedirect(route('admin.cohs.contact.edit'))
            ->assertSessionHas('status');

        CohsLandingRepository::flushCache();
        $landing = app(CohsLandingRepository::class)->forSchool($cohs);

        $this->assertSame('shs-updated@tenwekhosp.org', $landing['contact_page']['email'] ?? null);
        $this->assertSame('shs-updated@tenwekhosp.org', $landing['contact']['email'] ?? null);
        $this->assertSame('shs-updated@tenwekhosp.org', $landing['top_bar']['email'] ?? null);
        $this->assertSame('0711 111 111', $landing['top_bar']['call_display'] ?? null);
        $this->assertSame(['Line A', 'Line B'], $landing['contact']['location_lines'] ?? null);
        $this->assertSame(['0711 111 111', '0722 222 222'], $landing['contact']['phones'] ?? null);
        $this->assertSame('0711 111 111', $landing['contact_page']['phone_rows'][0]['numbers'][0]['display'] ?? null);
        $this->assertSame('https://facebook.com/tenwek', $landing['contact']['social_links'][0]['url'] ?? null);
        $this->assertStringContainsString('maps.google.com', (string) ($landing['map_embed_url'] ?? ''));

        $this->assertDatabaseHas('cohs_landing_sections', [
            'school_id' => $cohs->id,
            'section_key' => 'contact_page',
        ]);
        $this->assertNotNull(
            CohsLandingSection::query()
                ->where('school_id', $cohs->id)
                ->where('section_key', 'contact')
                ->first()
        );
    }
}
