<?php

namespace App\Http\Controllers;

use App\Models\Certificate;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Response;

class CertificateViewController extends Controller
{
    public function show(Certificate $certificate): Response
    {
        abort_unless($certificate->file_path, 404);

        $disk = Storage::disk('public');
        abort_unless($disk->exists($certificate->file_path), 404);

        $absolutePath = $disk->path($certificate->file_path);

        $contentType = $certificate->file_mime_type ?: $disk->mimeType($certificate->file_path);

        $filename = $certificate->file_original_name ?: basename($certificate->file_path);
        $safeFilename = str_replace(["\r", "\n", '"'], [' ', ' ', "'"], $filename);

        if ($contentType && str_starts_with($contentType, 'image/')) {
            $watermarked = $this->watermarkImage($absolutePath, $contentType);
            if ($watermarked) {
                return response($watermarked['bytes'], 200, [
                    'Content-Type' => $watermarked['content_type'],
                    'Content-Disposition' => 'inline; filename="'.$safeFilename.'"',
                    'X-Content-Type-Options' => 'nosniff',
                    'Cache-Control' => 'private, max-age=0, no-store',
                ]);
            }
        }

        return response()->file($absolutePath, [
            'Content-Type' => $contentType ?: 'application/octet-stream',
            'Content-Disposition' => 'inline; filename="'.$safeFilename.'"',
            'X-Content-Type-Options' => 'nosniff',
            'Cache-Control' => 'private, max-age=0, no-store',
        ]);
    }

    /**
     * Returns ['bytes' => string, 'content_type' => string] or null.
     */
    private function watermarkImage(string $absolutePath, string $contentType): ?array
    {
        if (! function_exists('imagecreatefromjpeg')) {
            return null;
        }

        $text = (string) config('app.certificate_watermark', env('CERTIFICATE_WATERMARK', config('app.name', 'Portfolio')));
        $text = trim($text);
        if ($text === '') {
            return null;
        }

        $image = match ($contentType) {
            'image/jpeg' => @imagecreatefromjpeg($absolutePath),
            'image/png' => @imagecreatefrompng($absolutePath),
            'image/webp' => function_exists('imagecreatefromwebp') ? @imagecreatefromwebp($absolutePath) : false,
            default => false,
        };

        if (! $image) {
            return null;
        }

        $width = imagesx($image);
        $height = imagesy($image);

        imagesavealpha($image, true);

        $font = 5; // built-in font (portable)
        $fontW = imagefontwidth($font);
        $fontH = imagefontheight($font);

        $stepX = max(180, (int) ($width / 3));
        $stepY = max(140, (int) ($height / 3));

        $alpha = 85; // 0 opaque, 127 transparent
        $color = imagecolorallocatealpha($image, 255, 255, 255, $alpha);

        $label = mb_strtoupper($text);
        $labelWidth = $fontW * mb_strlen($label);

        for ($y = -$stepY; $y < $height + $stepY; $y += $stepY) {
            for ($x = -$stepX; $x < $width + $stepX; $x += $stepX) {
                $drawX = $x + (int) (($stepX - $labelWidth) / 2);
                $drawY = $y + (int) (($stepY - $fontH) / 2);

                imagestring($image, $font, $drawX, $drawY, $label, $color);
            }
        }

        ob_start();
        $ok = match ($contentType) {
            'image/jpeg' => imagejpeg($image, null, 85),
            'image/png' => imagepng($image, null, 7),
            'image/webp' => function_exists('imagewebp') ? imagewebp($image, null, 80) : false,
            default => false,
        };
        $bytes = ob_get_clean();

        imagedestroy($image);

        if (! $ok || ! is_string($bytes) || $bytes === '') {
            return null;
        }

        return [
            'bytes' => $bytes,
            'content_type' => $contentType,
        ];
    }
}
