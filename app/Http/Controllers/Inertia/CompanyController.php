<?php

namespace App\Http\Controllers\Inertia;

use App\Models\Common\Company;
use Barryvdh\Debugbar\Controllers\BaseController;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class CompanyController extends BaseController
{
    public function update(Company $company, Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'accountant_price' => ['required', 'min:0', 'integer'],
            'lawyer_price' => ['required', 'min:0', 'integer'],
            'comment' => ['nullable'],
            'stripe_plan_id' => ['required', 'exists:stripe_plans,id'],
        ]);

        $company->fill($validated);
        $company->stripe_plan()->associate($validated['stripe_plan_id']);
        $company->save();

        return back()->with('success', 'Успешно додадовте цени за сметководител и адвокат');
    }
}
