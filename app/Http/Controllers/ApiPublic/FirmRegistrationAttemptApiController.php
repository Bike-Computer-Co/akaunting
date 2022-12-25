<?php

namespace App\Http\Controllers\ApiPublic;

use App\Http\Requests\FirmRegistrationAttemptRequest;
use App\Models\FirmRegistrationAttempt;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Routing\Controller as BaseController;

class FirmRegistrationAttemptApiController extends BaseController
{
    public function store(FirmRegistrationAttemptRequest $request): JsonResource
    {
        $attempt = FirmRegistrationAttempt::query()->create($request->validated());

        return JsonResource::make($attempt);
    }
}
