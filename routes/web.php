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

        $router->group(['prefix' => 'uac'], function () use ($router) {
            $router->post('set', 'UserAccessController@setUserAccess');
            $router->post('get', 'UserAccessController@getUserAccess');
        });
        $router->group(['prefix' => 'access'], function () use ($router) {
            $router->post('set', 'AccessController@setAccess');
            $router->post('alter', 'AccessController@alterAccess');
            $router->post('delete', 'AccessController@softDeleteAccess');
        });

        $router->group(['prefix' => 'token'], function () use ($router) {
            $router->post('checkauth', 'TokenController@verify');
            $router->post('invalidate', 'TokenController@inValidate');
        });

        $router->group(['prefix' => 'login'], function () use ($router) {
            $router->post('site-login', 'LoginController@sitelogin');
            $router->post('panel-login', 'LoginController@panellogin');
            $router->post('mobile-verification', 'LoginController@mobileverification');
        });

        $router->group(['prefix' => 'profile'], function () use ($router) {
            $router->post('/', 'ProfileController@profile');
        });

        $router->group(['prefix' => 'user'], function () use ($router) {
            $router->post('get', 'UserController@get');
            $router->post('user', 'UserController@update');
            $router->post('delete', 'UserController@safedelete');
            $router->post('setpassword', 'UserController@setPassword');
            $router->post('site-register', 'UserController@siteregister');
            $router->post('panel-register', 'UserController@panelregister');
            $router->post('mobile-verification', 'UserController@mobileverification');
            $router->post('check-access', 'UserController@checkaccess');
        });
    });
});
