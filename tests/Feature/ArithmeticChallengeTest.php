<?php

namespace Tests\Feature;

use App\Models\School;
use App\Support\Forms\ArithmeticChallenge;
use Database\Seeders\TenwekFoundationSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ArithmeticChallengeTest extends TestCase
{
    use RefreshDatabase;

    public function test_challenge_endpoint_issues_prompt(): void
    {
        $response = $this->postJson(route('forms.math-challenge'));

        $response->assertOk()
            ->assertJsonStructure(['token', 'prompt', 'message']);
        $this->assertNotEmpty($response->json('token'));
        $this->assertMatchesRegularExpression('/\d+\s[+\-−]\s\d+/u', (string) $response->json('prompt'));
    }

    public function test_contact_rejects_missing_math_challenge(): void
    {
        $this->seed(TenwekFoundationSeeder::class);
        $cohs = School::query()->where('slug', 'cohs')->firstOrFail();

        $response = $this->from(route('schools.pages.show', ['school' => 'cohs', 'pageSlug' => 'contact-us']))
            ->post(route('contact.store'), [
                'name' => 'Bot',
                'email' => 'bot@example.com',
                'school_id' => $cohs->id,
            ]);

        $response->assertRedirect();
        $response->assertSessionHasErrors('math_challenge_answer');
        $this->assertDatabaseMissing('form_submissions', ['form_key' => 'contact']);
    }

    public function test_contact_rejects_wrong_math_answer(): void
    {
        $this->seed(TenwekFoundationSeeder::class);
        $cohs = School::query()->where('slug', 'cohs')->firstOrFail();
        ArithmeticChallenge::seedForTesting('bad-token', 9);

        $response = $this->from(route('schools.pages.show', ['school' => 'cohs', 'pageSlug' => 'contact-us']))
            ->post(route('contact.store'), [
                'name' => 'Bot',
                'email' => 'bot@example.com',
                'school_id' => $cohs->id,
                'math_challenge_token' => 'bad-token',
                'math_challenge_answer' => 1,
            ]);

        $response->assertSessionHasErrors('math_challenge_answer');
        $this->assertDatabaseMissing('form_submissions', ['form_key' => 'contact']);
    }

    public function test_contact_page_includes_arithmetic_guard(): void
    {
        $this->seed(TenwekFoundationSeeder::class);

        $response = $this->get(route('schools.pages.show', ['school' => 'cohs', 'pageSlug' => 'contact-us']));

        $response->assertOk();
        $response->assertSee('data-arithmetic-guard', false);
        $response->assertSee('Quick spam check', false);
    }
}
