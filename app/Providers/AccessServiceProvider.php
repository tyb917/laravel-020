<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AccessServiceProvider extends ServiceProvider
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
            \App\Repositories\Backend\Access\User\UserInterface::class,
            \App\Repositories\Backend\Access\User\UserRepository::class
        );

        $this->app->bind(
            \App\Repositories\Backend\Access\Role\RoleInterface::class,
            \App\Repositories\Backend\Access\Role\RoleRepository::class
        );

        $this->app->bind(
            \App\Repositories\Backend\Access\Permission\PermissionInterface::class,
            \App\Repositories\Backend\Access\Permission\PermissionRepository::class
        );
    }
}
