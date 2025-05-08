<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\View\Components\AppLayout;
use Illuminate\Support\Facades\Blade;

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
        Blade::component('layouts.app', AppLayout::class);
    }
}
