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
            return asset(ltrim($path, '/'));
        }

        $disk = UploadsDisk::name();
        $driver = (string) config("filesystems.disks.{$disk}.driver", 'local');

        // Cloud / remote disks keep their own absolute URLs.
        if (in_array($driver, ['s3', 'ftp', 'sftp'], true)) {
            return Storage::disk($disk)->url($relative);
        }

        // Local public disk: use request-aware url() (same idea as {{ url('/') }}),
        // not filesystems.disks.public.url which bakes APP_URL (often http://localhost).
        return url('storage/'.$relative);
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
}
