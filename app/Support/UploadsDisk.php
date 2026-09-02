<?php

namespace App\Support;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

final class UploadsDisk
{
    public static function name(): string
    {
        return (string) config('filesystems.uploads_disk', config('filesystems.default', 'public'));
    }

    public static function store(UploadedFile $file, string $directory): string
    {
        return $file->store(trim($directory, '/'), static::name());
    }

    public static function delete(?string $path): void
    {
        $relative = PublicAssetUrl::storageRelativePath($path);

        if ($relative === null) {
            return;
        }

        Storage::disk(static::name())->delete($relative);
    }
}
