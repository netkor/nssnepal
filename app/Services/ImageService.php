<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;

class ImageService
{
    public function upload(
        UploadedFile $file,
        string $directory,
        int $maxWidth = 1200,
        int $maxHeight = 1200,
        int $quality = 88,
        ?string $oldPath = null
    ): string {
        $destDir = public_path($directory);
        if (!is_dir($destDir)) {
            mkdir($destDir, 0755, true);
        }
        $filename = time() . '_' . uniqid() . '.webp';
        $destPath = $destDir . '/' . $filename;
        $src = $this->createImageFromFile($file);
        if (!$src) {
            $rawname = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move($destDir, $rawname);
            if ($oldPath) { $this->delete($oldPath); }
            return '/' . $directory . '/' . $rawname;
        }
        $src = $this->correctOrientation($src, $file->getRealPath());
        [$newW, $newH] = $this->calculateDimensions(imagesx($src), imagesy($src), $maxWidth, $maxHeight);
        $resized = imagecreatetruecolor($newW, $newH);
        imagealphablending($resized, false);
        imagesavealpha($resized, true);
        $t = imagecolorallocatealpha($resized, 0, 0, 0, 127);
        imagefilledrectangle($resized, 0, 0, $newW, $newH, $t);
        imagecopyresampled($resized, $src, 0, 0, 0, 0, $newW, $newH, imagesx($src), imagesy($src));
        imagewebp($resized, $destPath, $quality);
        imagedestroy($src);
        imagedestroy($resized);
        if ($oldPath) { $this->delete($oldPath); }
        return '/' . $directory . '/' . $filename;
    }

    public function delete(?string $path): void
    {
        if ($path && file_exists(public_path($path))) {
            @unlink(public_path($path));
        }
    }

    private function createImageFromFile(UploadedFile $file): mixed
    {
        $mime = $file->getMimeType();
        $path = $file->getRealPath();
        if (str_contains($mime, 'jpeg')) return imagecreatefromjpeg($path);
        if (str_contains($mime, 'png'))  return imagecreatefrompng($path);
        if (str_contains($mime, 'gif'))  return imagecreatefromgif($path);
        if (str_contains($mime, 'webp')) return imagecreatefromwebp($path);
        return false;
    }

    private function correctOrientation(mixed $image, string $path): mixed
    {
        if (!function_exists('exif_read_data')) return $image;
        try {
            $exif = @exif_read_data($path);
            $o = $exif['Orientation'] ?? 1;
        } catch (\Throwable $e) { return $image; }
        if ($o === 3) return imagerotate($image, 180, 0);
        if ($o === 6) return imagerotate($image, -90, 0);
        if ($o === 8) return imagerotate($image, 90, 0);
        return $image;
    }

    private function calculateDimensions(int $w, int $h, int $maxW, int $maxH): array
    {
        if ($w <= $maxW && $h <= $maxH) return [$w, $h];
        $r = min($maxW / $w, $maxH / $h);
        return [(int) round($w * $r), (int) round($h * $r)];
    }
}
