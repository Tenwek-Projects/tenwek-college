<?php

namespace App\Support;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

final class UploadsDisk
{
    public static function name(): string
    {
        return (string) config('filesystems.uploads_disk', config('filesystems.default', 'public'));
    }

    public static function store(UploadedFile $file, string $directory): string
    {
        $directory = trim($directory, '/');
        $disk = static::name();

        if ($webp = ImageWebpConverter::convert($file)) {
            $path = $directory.'/'.Str::uuid().'.webp';
            Storage::disk($disk)->put($path, $webp, ['ContentType' => 'image/webp']);

            return $path;
        }

        return $file->store($directory, $disk);
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
