<?php

namespace App\Traits;

use App\Enums\MediaUsage;
use App\Models\MediaFile;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\HigherOrderTapProxy;
use Intervention\Image\ImageManagerStatic as InterventionImage;

trait HasMedia
{
    public function uploadAndCreateMedia(UploadedFile $file, MediaUsage $usage = MediaUsage::DEFAULT, $folder = null)
    {
        $filename = MediaFile::calculateFilename($file, $folder);
        Storage::put($filename, file_get_contents($file));

        return MediaFile::make($this, $filename, $usage);
    }

    public function uploadAndCreateImage(UploadedFile $file, MediaUsage $usage = MediaUsage::DEFAULT, $folder = null, $width = 1920, $height = 1920): Media|HigherOrderTapProxy
    {
        $filename = MediaFile::calculateFilename($file, $folder);

        $img = InterventionImage::make($file->path())
            ->resize($width, $height, function ($const) {
                $const->aspectRatio();
                $const->upsize();
            })
            ->orientate();

        $img = $img->stream('jpg', 80)->__toString();
        Storage::put($filename, $img, ['CacheControl' => 'max-age=315360000']);

        return MediaFile::make($this, $filename, $usage);
    }

    private function morphOneImage(MediaUsage $usage = MediaUsage::DEFAULT): MorphOne
    {
        return $this->morphOne(MediaFile::class, 'belongs')
            ->where('usage', $usage);
    }

    private function morphManyImages(MediaUsage $usage = MediaUsage::DEFAULT): MorphMany
    {
        return $this->morphMany(MediaFile::class, 'belongs')
            ->where('usage', $usage);
    }

    private function morphOneFile(MediaUsage $usage = MediaUsage::FILE): MorphOne
    {
        return $this->morphOne(MediaFile::class, 'belongs')
            ->where('usage', $usage);
    }
}
