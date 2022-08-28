<?php

namespace App\Http\Controllers\ApiPublic;

use App\Abstracts\Http\Controller;
use Illuminate\Http\Resources\Json\JsonResource;

class Auth extends Controller
{

    public function check(): JsonResource
    {
        if (!auth()->check())
            return JsonResource::make([
                'success' => false
            ]);

        $user = auth()->user();
        $company = $user->withoutEvents(function () use ($user) {
            return $user->companies()->enabled()->first();
        });

        return JsonResource::make([
            'status' => true,
            'redirect' => route($user->landing_page, ['company_id' => $company->id])
        ]);
    }
}
