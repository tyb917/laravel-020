<?php

/**
 * Backend 路由
 * Namespaces indicate folder structure
 * Admin middleware groups web, auth, and routeNeedsPermission
 */
Route::group(['namespace' => 'Backend', 'as' => 'admin.'], function () {
    Route::group(['namespace' => 'Auth', 'as' => 'auth.'], function () {
        Route::get('login','LoginController@showLoginForm')->name('login');
        Route::post('login','LoginController@login');
        Route::post('logout','LoginController@logout')->name('logout');
    });
});

Route::group(['namespace' => 'Backend', 'as' => 'admin.', 'middleware' => 'admin'], function () {
    /**
     * These routes need view-backend permission
     * (good if you want to allow more than one group in the backend,
     * then limit the backend features by different roles or permissions)
     *
     * Note: Administrator has all permissions so you do not have to specify the administrator role everywhere.
     */
    Route::group(['namespace' => 'Access', 'as' => 'access.', 'prefix' => 'access'], function () {
        /**
         * 管理员路由
         */
        Route::get('/user/get', 'UserController@get')->name('user.get');
        Route::resource('/user', 'UserController');
        /**
         * 角色路由
         */
    	Route::get('/role/get', 'RoleController@get')->name('role.get');
    	Route::resource('/role', 'RoleController');
        /**
         * 权限路由
         */
        Route::get('/permission/get', 'PermissionController@get')->name('permission.get');
        Route::resource('/permission', 'PermissionController');
    });

    /**
     * 通知管理
     */
    Route::group(['namespace' => 'Notifications', 'as' => 'notification.', 'prefix' => 'notification'], function () {
        Route::get('/', 'IndexController@index')->name('index');//通知首页
        Route::resource('/sms', 'SmsController');//短信通知
        Route::resource('/mail', 'MailController');//邮件通知
        Route::resource('/push', 'PushController');//推送通知
        Route::resource('/payment', 'PaymentController');//支付通知
        Route::resource('/system', 'SystemController');//系统通知
    });
    /**
     * 营销管理
     */
    Route::group(['namespace' => 'Newsletters', 'as' => 'newsletter.', 'prefix' => 'newsletter'], function () {
        Route::resource('/', 'NewsletterController@index');//订阅
        Route::resource('/template', 'TemplateController');//订阅模板
        Route::resource('/subscriber', 'SubscriberController');//订阅用户
    });
        
    Route::get('/', 'DashboardController@index')->name('index');
    Route::get('/dashboard', 'DashboardController@index')->name('dashboard');
});