<?php

namespace App\Http\Controllers\Inertia;

use App\Models\MediaFile;
use Illuminate\Support\Facades\Storage;

class MediaFileController extends Controller
{
    public function __invoke(MediaFile $mediaFile)
    {
        $file = Storage::get($mediaFile->source);

        return response()->file($file);
    }
}
