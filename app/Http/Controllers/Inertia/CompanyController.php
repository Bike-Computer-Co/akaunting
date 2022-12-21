<?php

namespace App\Http\Controllers\Inertia;

use App\Models\Common\Company;
use App\Models\StripePlan;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;
use Laravel\Cashier\Exceptions\IncompletePayment;
use Laravel\Cashier\Exceptions\SubscriptionUpdateFailure;

class CompanyController extends Controller
{
    /**
     * @throws AuthorizationException
     * @throws SubscriptionUpdateFailure
     * @throws IncompletePayment
     */
    public function update(Company $company, Request $request): RedirectResponse
    {
        $this->authorize('hasAllPermissions', Company::class);
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
        elseif ($company->stripe_id !== $validated['stripe_plan_id']) {
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

    public function index(): Response
    {
        $this->authorize('hasAllPermissions', Company::class);
        $companies = Company::query()
            ->with('settings', 'stripe_plan')
            ->latest()
            ->paginate(20);

        return Inertia::render('Company/Index', compact('companies'));
    }
}
