<?php

namespace App\Providers;

use Validator;
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
        /**
         * 自定义验证规则(只能由小写字母组成且首字母必须大写！)
         */
        Validator::extend('alpha_dash_upr_first', function ($attribute, $value, $parameters)
        {
            if (!preg_match('/^[A-Z]+[a-z]*$/',$value)) {
                return false;
            }
            return true;
        });

        /**
         * 自定义验证规则(只能由小写字母、横杠组成)
         */
        Validator::extend('alpha_dash_except_num', function ($attribute, $value, $parameters)
        {
            if (!preg_match('/^[a-z\-]*$/',$value)) {
                return false;
            }
            return true;
        });
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
