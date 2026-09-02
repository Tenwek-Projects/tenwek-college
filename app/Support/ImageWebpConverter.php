<?php

namespace App\Support;

use Illuminate\Http\UploadedFile;

final class ImageWebpConverter
{
    private const QUALITY = 80;

    /** @var list<string> */
    private const CONVERTIBLE_MIMES = [
        'image/jpeg',
        'image/png',
        'image/gif',
        'image/webp',
        'image/bmp',
    ];

    public static function convert(UploadedFile $file): ?string
    {
        if (! extension_loaded('gd') || ! function_exists('imagewebp')) {
            return null;
        }

        $mime = (string) $file->getMimeType();
        if (! in_array($mime, self::CONVERTIBLE_MIMES, true)) {
            return null;
        }

        $image = @imagecreatefromstring((string) file_get_contents($file->getRealPath()));
        if ($image === false) {
            return null;
        }

        if (in_array($mime, ['image/png', 'image/gif', 'image/webp'], true)) {
            imagepalettetotruecolor($image);
            imagealphablending($image, true);
            imagesavealpha($image, true);
        }

        ob_start();
        $encoded = imagewebp($image, null, self::QUALITY);
        imagedestroy($image);

        if (! $encoded) {
            ob_end_clean();

            return null;
        }

        $bytes = ob_get_clean();

        return $bytes !== false && $bytes !== '' ? $bytes : null;
    }
}
