<?php

namespace App\Providers;

use App\View\Components\Footer;
use App\View\Components\NavBar;
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
        // Daftarkan komponen secara eksplisit supaya <x-navbar> dan <x-footer>
        // juga jalan di server Linux (hosting), yang membedakan huruf besar/kecil.
        Blade::component('navbar', NavBar::class);
        Blade::component('footer', Footer::class);
    }
}