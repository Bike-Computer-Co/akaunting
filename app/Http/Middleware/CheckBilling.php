<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckBilling
{
    public function handle(Request $request, Closure $next)
    {
//        //invite acountant
//        $check1 = $request->routeIs('users.store') && $request->roles == 4 && !company()->haveOption('invite_accountant');
//        $check2 = $request->routeIs('recurring-invoices.*')  && !company()->haveOption('recurring_invoices');
//        $check3 = $request->routeIs('settings.schedule.update') && !company()->haveOption('remind');
//        if ($check1 || $check2) {
//            flash('Ве молиме надградете го вашиот пакет за да ја користите таа опција')->error()->important();
//            if ($request->expectsJson()) {
//                return response()->json([
//                    'redirect' => route('billing.subscription')
//                ]);
//            } else {
//                return redirect()->route('billing.subscription');
//            }
//        }
        if (!company()->stripe_plan()->exists()) {
            return $next($request);
        }

        if (company() && company()->subscribed()) {
            return $next($request);
        }

        flash('Немате платена претплата. Платете ја вашата претплата <a style="text-decoration: underline;" href="'.route('billing.redirect').'">овде.</a>')->error()->important();
        if ($request->expectsJson()) {
            return response()->json([
                'redirect' => route('billing.subscription'),
            ]);
        } else {
            return redirect()->route('billing.subscription');
        }
    }
}
