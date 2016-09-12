<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

/**
 * 前端访问控制器
 */
/**
 * 登录退出路由
 */
Auth::routes();

Route::group(['namespace' => 'Frontend'], function () {
	/**
	 * 需要登录页面
	 */
	Route::group(['namespace' => 'User'], function() {
    	Route::get('/dashboard', 'DashboardController@index')->name('frontend.user.dashboard');
    });
	/**
	 * 不需要登录页面
	 */
    Route::get('/', 'IndexController@index')->name('frontend.index');
});

Route::get('ajax/geetest','Controller@getGeetest');