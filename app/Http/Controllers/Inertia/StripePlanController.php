<?php

namespace App\Http\Controllers\Inertia;

use App\Models\StripePlan;
use Barryvdh\Debugbar\Controllers\BaseController;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class StripePlanController extends BaseController
{
    public function index(): Response
    {
        $stripePlans = StripePlan::query()
            ->withCount('companies')
            ->paginate(20);

        return Inertia::render('StripePlan/Index', compact('stripePlans'));
    }

    public function store(Request $request): RedirectResponse
    {
        StripePlan::query()->create($request->validate([
            'name' => 'required',
            'stripe_id' => 'required',
        ]));

        return back()->with('success', 'Успешно креиравте Stripe пакет');
    }

    public function destroy(StripePlan $stripePlan): RedirectResponse
    {
        if ($stripePlan->companies()->exists()) {
            return back()->with('error', 'Постојат компании претплатени на овој пакет');
        }

        $stripePlan->delete();

        return back()->with('sucess', 'Успешно го избришавте овој пакет');
    }
}
