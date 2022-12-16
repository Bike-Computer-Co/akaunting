<?php

namespace App\Http\Controllers;

use App\Abstracts\Http\Controller;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

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
        abort_if(! company() || ! company()->stripe_plan_id, 400, 'free package');
        $checkout = $request->get('checkout');
        if ($checkout == 'success') {
            flash('Успешно се претплативте')->success()->important();
        }
        if ($checkout == 'error') {
            flash('Неуспешна претплата')->error();
        }

        $planPrice = company()->stripe_plan->name;

        $features = [
            [
                'Персонализирани фактури',
                'Трошоци',
                'Обврски',
                'Трансакции',
                'iOS и Android пристап',
                'Финансиски извештаи',
                'Потсетници за плаќање',
            ],
            [
                'Повторливи Фактури',
                'Поканете Сметководител',
                'Управување со платен список',
                'Team Flex Payments (Наскоро)',
                'Уплата со кредитна картичка',
                'Дигитално потпишување',
                'Консултации со адвокат',
            ],
        ];

        $invoices = company()->stripeInvoices();

        return view('billing.subscription', [
            'stripeKey' => config('cashier.key'),
            'checkout' => $request->get('checkout'),
            'features' => $features,
            'planPrice' => $planPrice,
            'invoices' => $invoices
        ]);
    }

    public function download_invoice($invoiceId): Response
    {
        return company()->downloadInvoice($invoiceId);
    }

    public function subscribe(Request $request)
    {
        abort_if(company()->subscribed(), 400, 'Already subscribed');
        abort_if(! company()->stripe_plan_id, 400, 'Doesnt have');
        $plan = company()->stripe_plan;
        $checkout = company()->newSubscription('default', $plan->stripe_id)->checkout([
            'success_url' => route('billing.subscription').'?checkout=success',
            'cancel_url' => route('billing.subscription').'?checkout=cancelled',
        ]);

        return response()->json([
            'session_id' => $checkout->id,
        ]);
    }

//    public function swap(Request $request)
//    {
//        $request->validate([
//            'price_id' => 'required',
//        ]);
//        $package = $this->getPackage($request);
//        company()->subscription()->swap($request->price_id);
//
//        return back();
//    }

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
