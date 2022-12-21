<?php

namespace App\Http\Requests;

use App\Enums\FormOfFirm;
use App\Enums\StakeDuration;
use App\Enums\StakeType;
use App\Enums\StampType;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class FirmRegistrationRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'form_of_firm' => ['required', Rule::in(FormOfFirm::DOO->value, FormOfFirm::TP->value)],
            'firm_name' => ['required', 'max:255'],
            'founder_name' => ['required', 'max:255'],
            'founder_address' => ['required', 'max:255'],
            'founder_embg' => ['required', 'size:13'],
            'founder_id_number' => ['required', 'size:8'],
            'manager_name' => ['required', 'max:255'],
            'manager_address' => ['required', 'max:255'],
            'manager_embg' => ['required', 'size:13'],
            'headquarters_address' => ['required', 'max:255'],
            'headquarters_municipality_id' => ['required', 'exists:municipalities,id'],
            'headquarters_settlement_id' => ['nullable', 'exists:settlements,id'],
            'subsidiary_address' => ['required', 'max:255'],
            'subsidiary_municipality_id' => ['required', 'exists:municipalities,id'],
            'subsidiary_settlement_id' => ['nullable', 'exists:settlements,id'],
            'occupation_code' => ['required', 'max:255'],
            'stake_duration' => ['required', Rule::in(StakeDuration::IMMEDIATELY->value, StakeDuration::NEXT_12_MONTHS->value)],
            'stake_type' => ['required', Rule::in(StakeType::MONEY->value, StakeType::NO_MONEY->value)],
            'bank_id' => ['required', 'exists:banks,id'],
            'email' => ['required', 'email'],
            'phone' => ['required', 'max:255'],
            'stamp_address' => ['nullable', 'max:255'],
            'stamp_type' => ['nullable', Rule::in(StampType::WOODEN->value, StampType::AUTOMATIC->value)],
        ];
    }
}
