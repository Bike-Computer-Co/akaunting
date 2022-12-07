<?php

namespace App\Http\Controllers\Inertia;

use App\Jobs\Auth\CreateUser;
use App\Jobs\Common\CreateCompany;
use App\Models\Auth\User;
use App\Models\StripePlan;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Validation\Rule;
use Inertia\Inertia;
use Inertia\Response;

class UserController extends BaseController
{
    public function index(): Response
    {
        $users = User::query()
            ->latest()
            ->paginate(20);

        return Inertia::render('User/Index', compact('users'));
    }

    public function show(User $user): Response
    {
        $stripePlans = StripePlan::all();
        $user->loadMissing('companies', 'companies.settings');

        return Inertia::render('User/Show', compact('user', 'stripePlans'));
    }

    public function create(): Response
    {
        $countries = collect(trans('countries'))->map(fn ($item, $key) => ['id' => $key, 'name' => $item])->values();

        return Inertia::render('User/Create', compact('countries'));
    }

    public function store(Request $request): RedirectResponse
    {
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

        DB::transaction(function () use ($validated) {
            dispatch_sync(new CreateCompany([
                'name' => $validated['company_name'],
                'domain' => '',
                'email' => $validated['email'],
                'currency' => $validated['currency'],
                'country' => $validated['country'],
                'locale' => $validated['locale'],
                'enabled' => '1',
            ]));

            return dispatch_sync(new CreateUser([
                'name' => $validated['name'],
                'email' => $validated['email'],
                'password' => $validated['password'],
                'locale' => $validated['locale'],
                'companies' => [company_id()],
                'roles' => ['1'],
                'enabled' => '1',
                'register' => true,
            ]));
        });
        Http::post('https://discord.com/api/webhooks/1015030296640499712/FnXmKnh7J_yrpFj3rYQCeh4H_Gj5xvOmu0SodV6K-gBRtaP9dt01egpbaZplsaQNGHa3', [
            'content' => 'New user is registered on DigitalHub',
            'embeds' => [
                [
                    'title' => "$validated[name] from $validated[company_name] registered",
                    'description' => "With email: $validated[email]",
                    'color' => '7506394',
                ],
            ],
        ]);

        return redirect()->route('super.users.index');
    }
}
