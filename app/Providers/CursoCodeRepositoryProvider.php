<?php

namespace CursoCode\Providers;

use Illuminate\Support\ServiceProvider;

class CursoCodeRepositoryProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            \CursoCode\Repositories\ClientRepository::class,
            \CursoCode\Repositories\ClientRepositoryEloquent::class
        );
    }
}
