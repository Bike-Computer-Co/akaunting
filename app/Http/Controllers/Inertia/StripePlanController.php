<?php

namespace App\Http\Controllers\Inertia;

use App\Models\StripePlan;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class StripePlanController extends Controller
{
    public function index(): Response
    {
        $this->authorize('hasAllPermissions', StripePlan::class);
        $stripePlans = StripePlan::query()
            ->withCount('companies')
            ->paginate(20);

        return Inertia::render('StripePlan/Index', compact('stripePlans'));
    }

    public function store(Request $request): RedirectResponse
    {
        $this->authorize('hasAllPermissions', StripePlan::class);
        StripePlan::query()->create($request->validate([
            'name' => 'required',
            'stripe_id' => 'required',
            'accountant' => 'boolean'
        ]));

        return back()->with('success', 'Успешно креиравте Stripe пакет');
    }

    public function destroy(StripePlan $stripePlan): RedirectResponse
    {
        $this->authorize('hasAllPermissions', StripePlan::class);
        if ($stripePlan->companies()->exists()) {
            return back()->with('error', 'Постојат компании претплатени на овој пакет');
        }

        $stripePlan->delete();

        return back()->with('sucess', 'Успешно го избришавте овој пакет');
    }
}
