<?php

namespace App\Http\Controllers\ApiPublic;

use Illuminate\Routing\Controller as BaseController;
use App\Http\Requests\GiftCodeRequest;
use App\Models\GiftCodeApplicant;
use App\Notifications\GiftCardNotification;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Notification;

class GiftCodeApplicantApiController extends BaseController
{
    public function store(GiftCodeRequest $request): JsonResource
    {
        Notification::route('mail', $request->validated()['email'])->notify(new GiftCardNotification($request->validated()));

        $application = new GiftCodeApplicant($request->validated());
        $application->save();

        return JsonResource::make($application);
    }
}
