<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', function()
{
	return View::make('home/index');
});
Route::get('brower', array('as' => 'brower', 'uses' => 'BaseController@brower'));
Route::controller('admin/login', 'Admin_LoginController');

Route::group(array('before' => 'auth'), function()
{
    //Route::controller('admin/index','Admin_IndexController');
    //Route::controller('admin/city','Admin_CityController');
    //Route::controller('admin/airport','Admin_AirportController');
    //Route::controller('admin/order','Admin_OrderController');
    //Route::controller('admin/user', 'Admin_UserController');
});


    Route::controller('admin/index','Admin_IndexController');