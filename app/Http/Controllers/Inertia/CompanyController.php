<?php

namespace App\Http\Controllers\Inertia;

use App\Models\Common\Company;
use App\Models\StripePlan;
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
            'stripe_plan_id' => ['nullable', 'exists:stripe_plans,id'],
        ]);

        if ($validated['stripe_plan_id'] == null) {
            $company->stripe_plan_id = null;
        }

        if ($company->stripe_id !== $validated['stripe_plan_id']) {
            $stripePlan = StripePlan::find($validated['stripe_plan_id']);
            if ($company->subscribed()) {
                $company->subscription()->swap($stripePlan->stripe_id);
            }
        }
        $company->fill($validated);
        $company->stripe_plan()->associate($validated['stripe_plan_id']);
        $company->save();

        return back()->with('success', 'Успешно додадовте цени за сметководител и адвокат');
    }
}
