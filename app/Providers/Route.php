<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as Provider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route as Facade;

class Route extends Provider
{
    /**
     * The path to the "home" route for your application.
     *
     * This is used by Laravel authentication to redirect users after login.
     *
     * @var string
     */
    public const HOME = '/';

    /**
     * This namespace is applied to your controller routes.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $namespace = 'App\Http\Controllers';

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        parent::register();

        Facade::macro('module', function ($alias, $routes, $attrs) {
            $attributes = [
                'middleware' => [$attrs['middleware'], 'tenant'],
            ];

            if (isset($attrs['namespace'])) {
                // null means don't add
                if (!is_null($attrs['namespace'])) {
                    $attributes['namespace'] = $attrs['namespace'];
                }
            } else {
                $attributes['namespace'] = 'Modules\\' . module($alias)->getStudlyName() . '\Http\Controllers';
            }

            if (isset($attrs['prefix'])) {
                // null means don't add
                if (!is_null($attrs['prefix'])) {
                    $attributes['prefix'] = '{company_id}/' . $attrs['prefix'];
                }
            } else {
                $attributes['prefix'] = '{company_id}/' . $alias;
            }

            if (isset($attrs['as'])) {
                // null means don't add
                if (!is_null($attrs['as'])) {
                    $attributes['as'] = $attrs['as'];
                }
            } else {
                $attributes['as'] = $alias . '.';
            }

            return Facade::group($attributes, $routes);
        });

        Facade::macro('admin', function ($alias, $routes, $attributes = []) {
            return Facade::module($alias, $routes, array_merge([
                'middleware'    => 'admin',
            ], $attributes));
        });

        Facade::macro('preview', function ($alias, $routes, $attributes = []) {
            return Facade::module($alias, $routes, array_merge([
                'middleware'    => 'preview',
                'prefix'        => 'preview/' . $alias,
                'as'            => 'preview.' . $alias . '.',
            ], $attributes));
        });

        Facade::macro('portal', function ($alias, $routes, $attributes = []) {
            return Facade::module($alias, $routes, array_merge([
                'middleware'    => 'portal',
                'prefix'        => 'portal/' . $alias,
                'as'            => 'portal.' . $alias . '.',
            ], $attributes));
        });

        Facade::macro('signed', function ($alias, $routes, $attributes = []) {
            return Facade::module($alias, $routes, array_merge([
                'middleware'    => 'signed',
                'prefix'        => 'signed/' . $alias,
                'as'            => 'signed.' . $alias . '.',
            ], $attributes));
        });

        Facade::macro('api', function ($alias, $routes, $attributes = []) {
            return Facade::module($alias, $routes, array_merge([
                'namespace'     => 'Modules\\' . module($alias)->getStudlyName() . '\Http\Controllers\Api',
                'domain'        => config('api.domain'),
                'middleware'    => config('api.middleware'),
                'prefix'        => config('api.prefix') ? config('api.prefix') . '/' . $alias : $alias,
                'as'            => 'api.' . $alias . '.',
            ], $attributes));
        });
    }

    /**
     * Define the routes for the application.
     *
     * @return void
     */
    public function map()
    {
        $this->configureRateLimiting();

        foreach ($this->centralDomains() as $domain) {
            $this->mapWebRoutes();
            $this->mapApiRoutes();
        }
    }

    protected function mapWebRoutes()
    {
        foreach ($this->centralDomains() as $domain) {
            Facade::middleware('web')
                ->domain($domain)
                ->namespace($this->namespace)
                ->group(base_path('routes/central/web.php'));
        }
    }

    protected function mapApiRoutes()
    {
        foreach ($this->centralDomains() as $domain) {
            Facade::prefix('api')
                ->domain($domain)
                ->middleware('api')
                ->namespace($this->namespace)
                ->group(base_path('routes/central/api.php'));
        }
    }

    protected function centralDomains(): array
    {
        return config('tenancy.central_domains');
    }

    /**
     * Configure the rate limiters for the application.
     *
     * @return void
     */
    protected function configureRateLimiting()
    {
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(config('app.throttles.api'));
        });

        RateLimiter::for('import', function (Request $request) {
            return Limit::perMinute(config('app.throttles.import'));
        });
    }
}
