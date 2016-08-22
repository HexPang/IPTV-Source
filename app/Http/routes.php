<?php
use App\Http\Controllers\DashBoardController;
use App\Version;
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
$app->get('/t/{hash}','ChannelController@GetChannelViaHTML');
$app->get('/s/{hash}','ChannelController@GetChannel');
$app->get('/login',['as'=>'login','uses'=>'DashBoardController@ShowLogin']);
$app->post('/dashboard/login','DashBoardController@PostLogin');
$app->get('/','ChannelController@GetIndex');
$app->group(['prefix' => 'dashboard','middleware' => 'auth','namespace' => 'App\Http\Controllers'], function () use ($app) {
    $app->get('/','DashBoardController@ShowIndex');
    $app->post('/api/{action}','DashBoardController@API_POST');
    $app->get('/api/{action}','DashBoardController@API');
});