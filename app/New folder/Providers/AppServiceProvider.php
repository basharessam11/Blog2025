<?php

namespace App\Providers;

use App\Models\Setting;
use Illuminate\Support\Facades\Config;
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


        $settings = Setting::findOrFail(1)  ;

        Config::set('zoom.client_id', $settings->ZOOM_CLIENT_KEY);
        Config::set('zoom.client_secret', $settings->ZOOM_CLIENT_SECRET);
        Config::set('zoom.account_id', $settings->ZOOM_ACCOUNT_ID);
    }
}
