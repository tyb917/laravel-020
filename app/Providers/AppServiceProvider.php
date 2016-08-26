<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        /**
         * 服务管理逻辑绑定
         */
        $this->app->bind(
            \App\Repositories\Backend\Service\ServiceInterface::class,
            \App\Repositories\Backend\Service\ServiceRepository::class
        );
    }
}
