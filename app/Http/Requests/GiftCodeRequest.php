<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use JetBrains\PhpStorm\ArrayShape;

class GiftCodeRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    #[ArrayShape(['name_surname' => 'string[]', 'email' => 'string[]', 'phone_number' => 'string[]', 'registered_firm' => 'string[]', 'accountant' => 'string[]', 'advocate' => 'string[]', 'code' => 'string[]'])]
    public function rules(): array
    {
        return [
            'name_surname' => ['required', 'max:100'],
            'email' => ['required', 'email', 'max:255'],
            'phone_number' => ['required', 'max:255'],
            'registered_firm' => ['required', 'boolean'],
            'accountant' => ['required', 'boolean'],
            'advocate' => ['required', 'boolean'],
            'code' => ['required', 'max:255'],
        ];
    }
}
