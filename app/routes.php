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

Route::get('/', 'IndexController@Index');
Route::get('brower', array('as' => 'brower', 'uses' => 'BaseController@brower'));
Route::post('validate-key', array('as' => 'validate-key', 'uses' => 'BaseController@postValidateKey'));
Route::controller('admin/login', 'Admin_LoginController');

Route::controller('login', 'LoginController');
Route::controller('register', 'RegisterController');
Route::controller('news', 'NewsController');
Route::controller('about', 'AboutController');
Route::controller('job', 'JobController');
Route::controller('forget-password', 'ForgetPasswordController');
Route::controller('agreement', 'AgreementController');
Route::get('change-lang/{lang}', 'CommonController@changeLang')->where(array('lang','[a-z]{2}'));
Route::get('error/{n}', 'CommonController@error')->where(array('n','[0-9]{3}'));

Route::controller('workflow', 'WorkflowController');
Route::controller('order', 'OrderController');

Route::group(array('before' => 'auth'), function()
{
    Route::controller('user','UserController');
});
Route::controller('pay', 'PayController');
Route::controller('city', 'CityController');

Route::group(array('before' => 'admin_auth'), function()
{
    Route::controller('admin/index','Admin_IndexController');
    Route::controller('admin/city','Admin_CityController');
    Route::controller('admin/airport','Admin_AirportController');
    Route::controller('admin/order','Admin_OrderController');
    Route::controller('admin/user', 'Admin_UserController');
    Route::controller('admin/setting', 'Admin_SettingController');
    Route::controller('admin/about', 'Admin_AboutController');
    Route::controller('admin/job', 'Admin_JobController');
    Route::controller('admin/news', 'Admin_NewsController');
    Route::controller('admin/export', 'Admin_ExportController');

    Route::post('upload-img','BaseController@postUploadImg');
});


Route::any('uploadHandler/{width?}/{height?}/{width2?}/{height2?}', 'UploadHandlerController@initialize',
            function($width=null){ return $width;},function($height=null){ return $height;},
            function($width2=null){ return $width2;},function($height2=null){ return $height2;})
            ->where(array('width' => '[0-9]+','height' => '[0-9]+','width2' => '[0-9]+','height2' => '[0-9]+'));