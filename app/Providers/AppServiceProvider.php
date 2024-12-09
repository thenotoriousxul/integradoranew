<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Spatie\Permission\Middlewares\RoleMiddleware;
use App\Http\View\Composers\CarritoComposer;
use App\Models\Envios;
use App\Observers\EnvioObserver;

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
        View::composer('*', CarritoComposer::class);
        Envios::observe(EnvioObserver::class);

    }
}
