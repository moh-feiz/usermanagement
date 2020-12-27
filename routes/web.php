<?php

/** @var \Laravel\Lumen\Routing\Router $router */

use FastRoute\Route;
use Illuminate\Http\Request;

use Illuminate\Support\Str;
use Laravel\Passport\Client;

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



$router->group(['prefix' => 'api'], function () use ($router) {
    $router->group(['prefix' => 'v1'], function () use ($router) {
        $router->post('/sitelogin', 'LoginController@sitelogin');
        $router->post('/panellogin', 'LoginController@panellogin');
        $router->post('/mobile-verification', 'LoginController@mobileverification');

    });
});

$router->group(['prefix' => 'api'], function () use ($router) {
    $router->group(['prefix' => 'v1'], function () use ($router) {
        $router->group(['prefix' => 'token'], function () use ($router) {
            $router->post('checkauth', 'TokenController@verify');
            $router->post('invalidate', 'TokenController@inValidate');
        });
    });
});

$router->group(['prefix' => 'api'], function () use ($router) {
    $router->group(['prefix' => 'v1'], function () use ($router) {
        $router->group(['prefix' => 'user'], function () use ($router) {
            $router->post('get', 'UserController@get');
            $router->post('update', 'UserController@updateuser');
            $router->post('siteregister', 'UserController@siteregister');
            $router->post('panelregister', 'UserController@panelregister');
        });
    });
});

