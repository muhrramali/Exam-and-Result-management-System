<?php

namespace App\Providers;

use App\Models\SchoolClass;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\URL;
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
        // Railway terminates TLS at its edge proxy; force https on generated
        // URLs (forms, redirects, assets) so we don't depend solely on
        // X-Forwarded-Proto header detection, which causes mixed-content
        // errors like "form submitted over an insecure connection" if missed.
        if ($this->app->environment('production')) {
            URL::forceScheme('https');
        }

        Route::bind('class', fn (string $value) => SchoolClass::where('Class_ID', $value)->firstOrFail());

        Paginator::useTailwind();
    }
}
