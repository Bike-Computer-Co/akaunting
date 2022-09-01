<?php

namespace App\Http\Controllers\Auth;

use App\Abstracts\Http\Controller;
use App\Jobs\Auth\CreateUser;
use App\Jobs\Common\CreateCompany;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Validation\Rule;

class FullRegister extends Controller
{
    use AuthenticatesUsers;

    public function __construct()
    {
        $this->middleware('guest');
    }

    public function create()
    {
//        $locales = collect(config('language.all'))->map(fn($item) => ['id' => $item['long'], 'name' => $item['english']]);
//        $currencies = collect(config('money'))->map(fn($item, $key) => ['id' => $key, 'name' => $item['name']]);
        $countries = collect(trans('countries'))->map(fn($item, $key) => ['id' => $key, 'name' => $item])->values();
        return JsonResource::make(compact('countries'));
    }

    public function store(Request $request)
    {

        $locales = collect(config('language.all'))->map(fn($item) => $item['long']);
        $currencies = collect(config('money'))->map(fn($item, $key) => $key);
        $countries = collect(trans('countries'))->map(fn($item, $key) => $key);


        $validated = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8',

            'company_name' => 'required|unique:settings,value',
            'locale' => ['required', Rule::in($locales)],
            'currency' => ['required', Rule::in($currencies)],
            'country' => ['required', Rule::in($countries)],
        ]);

        $user = DB::transaction(function () use ($validated) {
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
                'register' => true
            ]));
        });
        auth()->loginUsingId($user->id);
        Http::post('https://discord.com/api/webhooks/1015030296640499712/FnXmKnh7J_yrpFj3rYQCeh4H_Gj5xvOmu0SodV6K-gBRtaP9dt01egpbaZplsaQNGHa3', [
            'content' => "New user registration",
            'embeds' => [
                [
                    'title' => "New user registration!",
                    'description' => "New user registration!",
                    'color' => '7506394',
                ]
            ],
        ]);
        return JsonResource::make(['success' => true, 'redirect' => route('wizard.edit', company_id())]);

    }
}
