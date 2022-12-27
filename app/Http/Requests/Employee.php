<?php

namespace App\Http\Requests;

use App\Abstracts\Http\FormRequest;

class Employee extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'first_name' => 'required',
            'last_name' => 'required',
            'personal_number' => 'required',
            'birth_date' => 'nullable|date_format:Y-m-d',
            'bank_account' => 'nullable',
            'occupation' => 'nullable',
            'address' => 'nullable',
            'email' => 'nullable|email',
            'phone' => 'nullable',
            'salary' => 'nullable|integer',
            'enabled' => 'nullable|boolean',
            'sign_up_employment_history' => 'required'
        ];
    }
}
