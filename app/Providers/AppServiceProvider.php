<?php

namespace App\Providers;

use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     */
    public function boot()
    {
        Schema::defaultStringLength(191); // Fix temprary the key length bug in older MySQL versions.
    }

    /**
     * Register any application services.
     */
    public function register()
    {
    }
}
