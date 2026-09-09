<?php

namespace Tests\Feature;

use App\Models\CohsBoardMember;
use App\Models\School;
use App\Models\User;
use Database\Seeders\CohsBoardMembersSeeder;
use Database\Seeders\TenwekFoundationSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class CohsBoardMembersAdminTest extends TestCase
{
    use RefreshDatabase;

    public function test_cohs_admin_can_manage_board_member_with_photo(): void
    {
        Storage::fake('public');
        $this->seed(TenwekFoundationSeeder::class);
        $user = User::query()->where('email', 'cohs.admin@tenwekhospitalcollege.ac.ke')->firstOrFail();
        $cohs = School::query()->where('slug', 'cohs')->firstOrFail();

        $this->actingAs($user)
            ->get(route('admin.cohs.board.index'))
            ->assertOk()
            ->assertSee('Hospital board members', false);

        $this->actingAs($user)
            ->post(route('admin.cohs.board.store'), [
                'name' => 'Test Chair',
                'role_title' => 'Board Chair',
                'bio' => 'Leads hospital governance.',
                'sort_order' => 1,
                'highlight' => '1',
                'is_published' => '1',
                'image' => UploadedFile::fake()->image('chair.jpg', 400, 500),
            ])
            ->assertRedirect(route('admin.cohs.board.index'));

        $member = CohsBoardMember::query()->where('school_id', $cohs->id)->where('name', 'Test Chair')->first();
        $this->assertNotNull($member);
        $this->assertTrue($member->highlight);
        $this->assertNotEmpty($member->image_path);

        $this->get(route('schools.pages.show', [$cohs, 'about-us']))
            ->assertOk()
            ->assertSee('Test Chair', false)
            ->assertSee('Leads hospital governance.', false);
    }

    public function test_board_seeder_imports_config_members(): void
    {
        $this->seed(TenwekFoundationSeeder::class);
        $this->seed(CohsBoardMembersSeeder::class);

        $cohs = School::query()->where('slug', 'cohs')->firstOrFail();
        $this->assertGreaterThanOrEqual(1, CohsBoardMember::query()->where('school_id', $cohs->id)->count());
        $this->assertDatabaseHas('cohs_board_members', [
            'school_id' => $cohs->id,
            'name' => 'Rev. Dr. Robert Langat',
        ]);
    }
}
