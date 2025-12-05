<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\HelperService;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(HelperService::class, function(){
            return new HelperService();
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
