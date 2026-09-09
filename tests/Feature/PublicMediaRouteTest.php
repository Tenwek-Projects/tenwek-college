<?php

namespace Tests\Feature;

use App\Support\PublicAssetUrl;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class PublicMediaRouteTest extends TestCase
{
    use RefreshDatabase;

    public function test_media_route_serves_upload_and_url_helper_uses_media_prefix(): void
    {
        $disk = \App\Support\UploadsDisk::name();
        Storage::fake($disk);
        $path = 'cohs/2/board/test-portrait.webp';
        Storage::disk($disk)->put($path, 'fake-image-bytes');

        $this->assertStringContainsString('/media/'.$path, (string) PublicAssetUrl::toUrl($path));

        $this->get('/media/'.$path)
            ->assertOk();
    }

    public function test_media_route_rejects_path_traversal(): void
    {
        $this->get('/media/../.env')->assertNotFound();
    }
}
