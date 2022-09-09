<?php

/** @var \Laravel\Lumen\Routing\Router $router */

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->group(['prefix' => 'api/v1','namespace' => 'App\Http\Controllers'], function($app)
{
    $app->post('user','\App\Http\Controllers\UserController@createUser');

    $app->get('user/{id}','\App\Http\Controllers\UserController@viewUser');

    $app->put('user/{id}','\App\Http\Controllers\UserController@updateUser');

    $app->delete('user/{id}','\App\Http\Controllers\UserController@deleteUser');

    $app->get('user','\App\Http\Controllers\UserController@index');

    $app->post('user/verify-referral-code','\App\Http\Controllers\UserController@verify_referral_code');
});
