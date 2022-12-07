<?php

namespace App\Http\Controllers;

use App\Abstracts\Http\Controller;
use Illuminate\Http\Request;

class BillingController extends Controller
{
    public function redirect(Request $request)
    {
        $company = company();
        $company->createOrGetStripeCustomer();

        return $company->redirectToBillingPortal(route('billing.subscription'));
    }

    public function subscription(Request $request)
    {
        $yearly = $request->has('yearly');

        return view('billing.subscription', [
            'stripeKey' => config('cashier.key'),
            'packages' => config('packages'),
            'yearly' => $yearly,
            'keyword' => $yearly ? 'yearly' : 'monthly',
        ]);
    }

    private function getPackage(Request $request)
    {
        $monthly = collect(config('packages'))->where('monthly_stripe_id', $request->price_id)->first();
        $yearly = collect(config('packages'))->where('yearly_stripe_id', $request->price_id)->first();
        if (! $monthly && ! $yearly) {
            abort(400);
        }

        return $monthly ?? $yearly;
    }

    public function subscribe(Request $request)
    {
        $request->validate([
            'price_id' => 'required',
            'trial' => 'required|boolean',
        ]);
        abort_if(company()->subscribed(), 400, 'Already subscribed');
        $package = $this->getPackage($request);

        $checkout = company()->newSubscription('default', $request->price_id);

        if ($request->trial && $package['trial_days']) {
            $checkout = $checkout->trialDays($package['trial_days'] + 1);
        }

        $checkout = $checkout
            ->checkout([
                'success_url' => route('billing.subscription').'?checkout=success',
                'cancel_url' => route('billing.subscription').'?checkout=cancelled',
            ]);

        return response()->json([
            'session_id' => $checkout->id,
        ]);
    }

    public function swap(Request $request)
    {
        $request->validate([
            'price_id' => 'required',
        ]);
        $package = $this->getPackage($request);
        company()->subscription()->swap($request->price_id);

        return back();
    }

    public function cancel(Request $request)
    {
        abort_if(! company()->subscribed(), 400);
        company()->subscription()->cancel();

        return back();
    }

    public function resume(Request $request)
    {
        abort_if(! company()->subscription()->onGracePeriod(), 400);
        company()->subscription()->resume();

        return back();
    }
}
