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
        $router->get('/', ['middleware' => 'x-key', 'uses' => 'NoteController@index']);
        $router->post('/create', ['middleware' => 'x-key', 'uses' =>'NoteController@store']);
        $router->get('/{slug}', ['middleware' => 'x-key', 'uses' => 'NoteController@show']);
        $router->put('/{slug}', ['middleware' => 'x-key', 'uses' => 'NoteController@update']);
        $router->delete('/{slug}', ['middleware' => 'x-key', 'uses' => 'NoteController@destroy']);
    });

    $router->group(['prefix' => 'key',
                    'namespace' => 'Key',], function () use ($router) 
    {
        $router->post('/register', 'KeyController@registerKey');
        $router->post('/get-key', 'KeyController@getKey');
    });

});
