<?php

namespace App\Traits;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

trait HandlesImageUploads
{
    protected function storeImage(UploadedFile $file, string $folder): string
    {
        $filename = Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME))
            . '-' . uniqid() . '.' . $file->getClientOriginalExtension();

        return $file->storeAs($folder, $filename, 'public');
    }

    protected function deleteImage(?string $path): void
    {
        if ($path && Storage::disk('public')->exists($path)) {
            Storage::disk('public')->delete($path);
        }
    }

    protected function uniqueSlug(string $string, string $model, ?int $ignoreId = null): string
    {
        $slug = Str::slug($string);
        $original = $slug;
        $i = 1;

        $query = fn ($s) => $model::where('slug', $s)
            ->when($ignoreId, fn ($q) => $q->where('id', '!=', $ignoreId))
            ->exists();

        while ($query($slug)) {
            $slug = "{$original}-{$i}";
            $i++;
        }

        return $slug;
    }
}
