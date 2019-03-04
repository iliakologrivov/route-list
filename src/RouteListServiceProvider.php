<?php

namespace Iliakologrivov\Routelist;

use Illuminate\Support\ServiceProvider;

class RouteListServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->commands([RouteListCommand::class]);
    }
}
