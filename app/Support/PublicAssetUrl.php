<?php

namespace App\Support;

use Illuminate\Support\Facades\Storage;

class PublicAssetUrl
{
    public static function toUrl(?string $path): ?string
    {
        if (! $path) {
            return null;
        }

        if (str_starts_with($path, 'http://') || str_starts_with($path, 'https://') || str_starts_with($path, '//')) {
            return $path;
        }

        $relative = static::storageRelativePath($path);

        if ($relative === null) {
            return static::absoluteUrl(asset(ltrim($path, '/')));
        }

        $disk = UploadsDisk::name();
        $generated = Storage::disk($disk)->url($relative);

        return static::absoluteUrl($generated);
    }

    public static function storageRelativePath(?string $path): ?string
    {
        $path = trim((string) $path);

        if ($path === '') {
            return null;
        }

        $relative = ltrim(str_replace('\\', '/', $path), '/');

        if (str_starts_with($relative, 'storage/')) {
            $relative = substr($relative, strlen('storage/'));
        }

        if (str_starts_with($relative, 'build/')) {
            return null;
        }

        if (! str_contains($relative, '/') && is_file(public_path($relative))) {
            return null;
        }

        if (str_contains($relative, '/')) {
            return $relative;
        }

        return null;
    }

    /**
     * Force a full absolute URL using APP_URL when Storage/asset return a root-relative path.
     */
    private static function absoluteUrl(string $url): string
    {
        $url = trim($url);
        if ($url === '') {
            return $url;
        }

        if (str_starts_with($url, 'http://') || str_starts_with($url, 'https://') || str_starts_with($url, '//')) {
            return $url;
        }

        $base = rtrim((string) config('app.url'), '/');
        if ($base === '') {
            return url($url);
        }

        return $base.'/'.ltrim($url, '/');
    }
}
