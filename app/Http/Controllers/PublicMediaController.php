<?php

namespace App\Http\Controllers;

use App\Support\PublicAssetUrl;
use App\Support\UploadsDisk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\StreamedResponse;

/**
 * Serves files from the uploads disk without relying on public/storage symlink
 * (symlink access often returns 403 on locked-down hosts).
 */
class PublicMediaController extends Controller
{
    public function show(Request $request, string $path): StreamedResponse
    {
        $relative = PublicAssetUrl::storageRelativePath($path) ?? ltrim(str_replace('\\', '/', $path), '/');

        abort_if($relative === '' || str_contains($relative, '..'), 404);

        $disk = Storage::disk(UploadsDisk::name());
        abort_unless($disk->exists($relative), 404);

        $mime = $disk->mimeType($relative) ?: 'application/octet-stream';

        return $disk->response($relative, null, [
            'Content-Type' => $mime,
            'Cache-Control' => 'public, max-age=604800',
        ]);
    }
}
