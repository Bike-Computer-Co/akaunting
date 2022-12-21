<?php

namespace App\Http\Controllers\ApiPublic;

use App\Http\Requests\FirmRegistrationRequest;
use App\Models\Bank;
use App\Models\FirmRegistration;
use App\Models\Municipality;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Routing\Controller as BaseController;

class FirmRegistrationApiController extends BaseController
{
    public function index(): AnonymousResourceCollection
    {
        $municipalities = Municipality::query()
            ->with('settlements')
            ->get();

        $banks = Bank::all();

        return JsonResource::collection([
            'municipalities' => $municipalities,
            'banks' => $banks,
        ]);
    }

    public function store(FirmRegistrationRequest $request): JsonResource
    {
        $firm = FirmRegistration::createFirmRegistration($request);

        return JsonResource::make($firm);
    }
}
