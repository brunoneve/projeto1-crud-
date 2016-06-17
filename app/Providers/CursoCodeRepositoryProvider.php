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
            \CursoCode\Repositories\UserRepository::class,
            \CursoCode\Repositories\UserRepositoryEloquent::class
        );
        $this->app->bind(
            \CursoCode\Repositories\ClientRepository::class,
            \CursoCode\Repositories\ClientRepositoryEloquent::class
        );
        $this->app->bind(
            \CursoCode\Repositories\ProjectRepository::class,
            \CursoCode\Repositories\ProjectRepositoryEloquent::class
        );
        $this->app->bind(
            \CursoCode\Repositories\ProjectNoteRepository::class,
            \CursoCode\Repositories\ProjectNoteRepositoryEloquent::class
        );
        $this->app->bind(
            \CursoCode\Repositories\ProjectTaskRepository::class,
            \CursoCode\Repositories\ProjectTaskRepositoryEloquent::class
        );
        $this->app->bind(
            \CursoCode\Repositories\ProjectMemberRepository::class,
            \CursoCode\Repositories\ProjectMemberRepositoryEloquent::class
        );
        $this->app->bind(
            \CursoCode\Repositories\ProjectFileRepository::class,
            \CursoCode\Repositories\ProjectFileRepositoryEloquent::class
        );
    }
}
