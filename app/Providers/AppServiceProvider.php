<?php

namespace App\Providers;

use App\Models\SchoolClass;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Route;
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
        Route::bind('class', fn (string $value) => SchoolClass::where('Class_ID', $value)->firstOrFail());

        Paginator::useTailwind();
    }
}
