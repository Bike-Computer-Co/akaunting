<?php

namespace App\Http\Controllers\Inertia;

use App\Models\Auth\User;
use App\Models\StripePlan;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Inertia\Inertia;
use Inertia\Response;

class UserController extends Controller
{
    public function index(): Response
    {
        $this->authorize('hasAllPermissions', User::class);
        $users = User::query()
            ->latest()
            ->paginate(20);

        return Inertia::render('User/Index', compact('users'));
    }

    public function show(User $user): Response
    {
        $this->authorize('hasAllPermissions', User::class);
        $stripePlans = StripePlan::all();
        $user->loadMissing('companies', 'companies.settings', 'companies.stripe_plan');

        return Inertia::render('User/Show', compact('user', 'stripePlans'));
    }

    public function create(): Response
    {
        $this->authorize('hasAllPermissions', User::class);
        $countries = collect(trans('countries'))->map(fn ($item, $key) => ['id' => $key, 'name' => $item])->values();

        return Inertia::render('User/Create', compact('countries'));
    }

    public function store(Request $request): RedirectResponse
    {
        $this->authorize('hasAllPermissions', User::class);
        $locales = collect(config('language.all'))->map(fn ($item) => $item['long']);
        $currencies = collect(config('money'))->map(fn ($item, $key) => $key);
        $countries = collect(trans('countries'))->map(fn ($item, $key) => $key);

        $validated = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8',

            'company_name' => 'required|unique:settings,value',
            'locale' => ['required', Rule::in($locales)],
            'currency' => ['required', Rule::in($currencies)],
            'country' => ['required', Rule::in($countries)],
        ]);
        User::createNewUser($validated);

        return redirect()->route('super.users.index');
    }
}
