<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use FPDF;

class FpdfServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind('fpdf', function () {
            return new FPDF();
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
