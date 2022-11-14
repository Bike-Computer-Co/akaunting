<?php

namespace App\Http\Controllers\ApiPublic;

use App\Abstracts\Http\Controller;
use App\Abstracts\Notification;
use App\Notifications\RegisterCompanyRequestNotification;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CompanyRegister extends Controller
{
    public function request(Request $request)
    {
        $validated = $request->validate([
            'merchant' => 'nullable',
            'company_name' => 'nullable',
            'name' => 'nullable',
            'address' => 'nullable',
            'personal_id' => 'nullable',
            'same_director_button' => 'nullable',
            'name_director' => 'nullable',
            'address_director' => 'nullable',
            'personal_id_director' => 'nullable',
            'bank' => 'nullable',
            'street' => 'nullable',
            'number' => 'nullable',
            'city' => 'nullable',
            'same_address_button' => 'nullable',
            'street_partner' => 'nullable',
            'number_partner' => 'nullable',
            'city_partner' => 'nullable',
            'selected_activity' => 'nullable',
            'option_1' => 'nullable',
            'option_2' => 'nullable'
        ]);

        \Illuminate\Support\Facades\Notification::route('mail', 'ivan@venikom.com')
            ->notify(new RegisterCompanyRequestNotification($validated));

        return JsonResource::make($request->all());
    }
}
