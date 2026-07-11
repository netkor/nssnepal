<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

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
        view()->composer(['layouts.app', 'layouts.admin'], function ($view) {
            $settings = \Illuminate\Support\Facades\Cache::rememberForever('site_settings', function () {
                return \App\Models\SiteSetting::pluck('value', 'key')->toArray();
            });
            $view->with('siteSettings', $settings);
        });
    }
}
