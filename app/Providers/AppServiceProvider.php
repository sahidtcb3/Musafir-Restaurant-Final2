<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\SiteSetting;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\URL;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */

public function boot(): void
{
    if (env('APP_ENV') === 'production') {
        URL::forceScheme('https');
    }

    try {
        View::share('site_settings', SiteSetting::first());
    } catch (\Exception $e) {
        View::share('site_settings', null);
    }
}
       
    }
}