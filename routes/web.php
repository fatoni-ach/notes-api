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

$router->group(['prefix' => 'v1',
                'namespace' => 'V1'], function () use ($router) 
{
    $router->group(['prefix' => 'notes',
                    'namespace' => 'Notes'], function () use ($router) 
    {
        $router->get('/', 'NoteController@index');
        $router->post('/create', 'NoteController@store');
        $router->get('/{slug}', 'NoteController@show');
        $router->put('/{slug}', 'NoteController@update');
    });
});
