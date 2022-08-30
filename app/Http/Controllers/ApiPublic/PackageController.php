<?php

namespace App\Http\Controllers\ApiPublic;

use App\Abstracts\Http\Controller;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Resources\Json\JsonResource;

class PackageController extends Controller
{
    public function packages(): AnonymousResourceCollection
    {
        return JsonResource::collection(config('packages'));
    }
}
