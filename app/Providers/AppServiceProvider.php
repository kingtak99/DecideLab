<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Validation\Rules\Password;

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
        // Set locale from session
        if (session()->has('locale')) {
            app()->setLocale(session('locale'));
        }

        Password::defaults(function () {
            return Password::min(8)
                ->letters()      // at least one letter
                ->mixedCase()    // uppercase + lowercase
                ->numbers()      // at least one number
                ->symbols();     // at least one special char
        });
    }
}
