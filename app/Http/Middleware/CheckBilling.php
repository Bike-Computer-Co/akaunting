<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckBilling
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {

        //invite acountant
        $check1 = $request->routeIs('users.store') && $request->roles == 4 && $this->haveOption('invite_accountant');
        if ($check1) {
            flash('Ве молиме надградете го вашиот пакет за да ја користите таа опција')->error()->important();
            if ($request->expectsJson()) {
                return response()->json([
                    'redirect' => route('billing.subscription')
                ]);
            } else {
                return redirect()->route('billing.subscription');
            }
        }

        return $next($request);
    }

    private function getPackage()
    {
        if (!company()->subscribed()) return config('packages')[0];
        foreach (config('packages') as $package) {
            if (!isset($package['monthly_stripe_id']) || !isset($package['yearly_stripe_id']))
                continue;
            if (company()->subscribedToPrice([$package['monthly_stripe_id'], $package['yearly_stripe_id']]))
                return $package;
        }
    }

    private function haveOption($option): bool
    {
        $package = $this->getPackage();
        if (!$package) return false;

        return in_array($option, $package['feature_keys']);
    }
}
