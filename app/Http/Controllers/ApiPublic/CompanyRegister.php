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
            'merchant' => 'required',
            'company_name' => 'required',
            'name' => 'required',
            'address' => 'required',
            'personal_id' => 'required',
            'same_director_button' => 'required',
            'name_director' => 'required',
            'address_director' => 'required',
            'personal_id_director' => 'required',
            'bank' => 'required',
            'street' => 'required',
            'number' => 'required',
            'city' => 'required',
            'same_address_button' => 'required',
            'street_partner' => 'required',
            'number_partner' => 'required',
            'city_partner' => 'required',
            'selected_activity' => 'required',
            'option_1' => 'required',
            'option_2' => 'required'
        ]);

        \Illuminate\Support\Facades\Notification::route('mail', 'ivan@venikom.com')
            ->notify(new RegisterCompanyRequestNotification($validated));

        return JsonResource::make($request->all());
    }
}
