<?php

namespace App\Providers;

use Illuminate\Support\Facades\Blade;
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
        Blade::component('app-layout', \App\View\Components\AppLayout::class);
        Blade::component('jet-input', \App\View\Components\JetInput::class);
        Blade::component('jet-label', \App\View\Components\JetLabel::class);
        Blade::component('jet-button', \App\View\Components\JetButton::class);
        Blade::component('jet-input-error', \App\View\Components\JetInputError::class);
        Blade::component('jet-checkbox', \App\View\Components\JetCheckbox::class);

    }
}
