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

        //detaching
        if ($validated['stripe_plan_id'] == null) {
            $company->stripe_plan_id = null;
            //We have attached plan, But maybe the client never Subscribed.
            if ($company->subscribed()) {
                $company->subscription()->cancel();
            }
        } //changing
        else if ($company->stripe_id !== $validated['stripe_plan_id']) {
            $stripePlan = StripePlan::find($validated['stripe_plan_id']);
            $company->stripe_plan()->associate($stripePlan);
            //swapping only if client have Subscribed
            if ($company->subscribed()) {
                $company->subscription()->swap($stripePlan->stripe_id);
            }
        }//if its same nothing happens


        $company->fill($validated);
        $company->save();

        return back()->with('success', 'Успешно додадовте цени за сметководител и адвокат');
    }
}
