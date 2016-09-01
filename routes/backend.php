<?php

/**
 * Backend 路由
 * Namespaces indicate folder structure
 * Admin middleware groups web, auth, and routeNeedsPermission
 */
Route::group(['namespace' => 'Backend', 'as' => 'admin.', 'middleware' => ['role:root|admin','permission:view-backend']], function () {
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
    Route::get('/dashboard', 'DashboardController@index')->name('dashboard');
});