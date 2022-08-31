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
        $checkout = company()->newSubscription('default', "price_1LcHl1J0xcYTmxxkn76cuuix")->checkout([
            'success_url' => route('billing.subscription') . '?checkout=success',
            'cancel_url' => route('billing.subscription') . '?checkout=cancelled',
        ]);

        return view('billing.subscription', [
            'stripeKey' => config('cashier.key'),
            'sessionId' => $checkout->id,
            'packages' => config('packages')
        ]);
    }
}
