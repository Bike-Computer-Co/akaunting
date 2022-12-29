<?php

namespace App\Http\Controllers\Inertia;

use App\Models\MediaFile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Str;

class MediaFileController extends Controller
{
    public function __invoke(MediaFile $mediaFile){
        $file= Storage::get($mediaFile->source);
        return response()->file($file);
    }
}
