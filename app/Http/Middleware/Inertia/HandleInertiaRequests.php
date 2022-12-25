<?php

namespace App\Http\Middleware\Inertia;

use App\Models\Auth\User;
use App\Models\Common\Company;
use App\Models\Employees\Employee;
use App\Models\FirmRegistration;
use App\Models\FirmRegistrationAttempt;
use App\Models\StripePlan;
use Illuminate\Http\Request;
use Inertia\Middleware;

class HandleInertiaRequests extends Middleware
{
    /**
     * The root template that's loaded on the first page visit.
     *
     * @see https://inertiajs.com/server-side-setup#root-template
     *
     * @var string
     */
    protected $rootView = 'app';

    /**
     * Determines the current asset version.
     *
     * @see https://inertiajs.com/asset-versioning
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    public function version(Request $request): ?string
    {
        return parent::version($request);
    }

    /**
     * Defines the props that are shared by default.
     *
     * @see https://inertiajs.com/shared-data
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function share(Request $request): array
    {
        $user = auth()->user();

        return array_merge(parent::share($request), [
            'error' => fn () => $request->session()->get('error'),
            'success' => fn () => $request->session()->get('success'),
            'can' => [
                'seeEmployees' => $user?->can('hasAllPermissions', Employee::class),
                'seeCompanies' => $user?->can('hasAllPermissions', Company::class),
                'seeStripePlans' => $user?->can('hasAllPermissions', StripePlan::class),
                'seeUsers' => $user?->can('hasAllPermissions', User::class),
                'seeFirmRegistrations' => $user?->can('hasAllPermissions', FirmRegistration::class),
                'seeFirmRegistrationAttempts' => $user?->can('hasAllPermissions', FirmRegistrationAttempt::class),
            ],
        ]);
    }
}
