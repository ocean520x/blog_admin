<?php

namespace App\Services;

use Spatie\Image\Image;
use Spatie\Image\Enums\Fit;

class UploadService
{
    public function image($file, $width = 800, $height = 800, $fit = Fit::Contain)
    {
        // attachments/xxxx.png
        $filePath = $file->store('attachments', 'public');
        // storage/app/attachments/xxxx.png
        $realPath = storage_path('app/public/' . $filePath);
        Image::load($realPath)->fit($fit, $width, $height)->save();
        return url('storage/' . $filePath);
    }
}
