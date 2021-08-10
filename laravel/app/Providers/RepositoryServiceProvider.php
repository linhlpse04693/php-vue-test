<?php

namespace App\Providers;

use App\Repositories\Role\RoleRepository;
use App\Repositories\Role\RoleRepositoryEloquent;
use App\Repositories\Status\StatusRepository;
use App\Repositories\Status\StatusRepositoryEloquent;
use App\Repositories\User\UserRepository;
use App\Repositories\User\UserRepositoryEloquent;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            RoleRepository::class,
            RoleRepositoryEloquent::class,
        );

        $this->app->bind(
            StatusRepository::class,
            StatusRepositoryEloquent::class,
        );

        $this->app->bind(
            UserRepository::class,
            UserRepositoryEloquent::class,
        );
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
