<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use Illuminate\Support\Facades\Blade;

use App\View\Components\Alert;

use App\View\Components\Inputs\Button;

use App\View\Components\Forms\Button as FormButton;

use Illuminate\Pagination\Paginator;

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
        //

        Blade::component('package-alert', Alert::class);
        Blade::component('input-button', Button::class);
        Blade::component('form-button', FormButton::class);
        Paginator::useBootstrapFour();
    }
}
