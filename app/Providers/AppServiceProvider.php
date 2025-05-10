<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        
    }

    public function boot()
    {
        if (config('app.env') === 'production') {
            \URL::forceScheme('https');
        }
    }
}