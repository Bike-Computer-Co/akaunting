<?php

namespace App\Http\Controllers\ApiPublic;

use Akaunting\Module\Routing\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class User extends Controller
{

    public function loggedRedirect(): JsonResource
    {
        if (!auth()->check())
            return JsonResource::make(['status' => false]);

        $user = auth();
        $company = $user->withoutEvents(function () use ($user) {
            return $user->companies()->enabled()->first();
        });

        return JsonResource::make([
            'status' => true,
            'redirect' => route($user->landing_page, ['company_id' => $company->id])
        ]);
    }
}
