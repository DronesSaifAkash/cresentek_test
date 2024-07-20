<?php

namespace App\Providers;

use App\View\Composers\CategoryComposer;
use Illuminate\Support\ServiceProvider;

use Illuminate\Support\Facades\View;
use App\View\Composers\ExampleComposer;

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
        View::composer('test', ExampleComposer::class);

        // Register the CategoryComposer to the 'layouts.sidebar' view
        View::composer('layouts.footer', CategoryComposer::class);
    }
}
