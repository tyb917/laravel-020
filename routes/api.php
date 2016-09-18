<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
$api = Api::router();

$api->version('v1', ['namespace' => 'App\Http\Controllers\Api\V1'], function ($api) {
   $api->get('/login','AuthController@authenticate');
   $api->get('/user', function (Request $request) {
   		dd($request);
	    return $request->user();
	})->middleware('auth:api');
});

// Route::get('/user', function (Request $request) {
//     return $request->user();
// });
