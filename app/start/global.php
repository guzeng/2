<?php

/*
|--------------------------------------------------------------------------
| Register The Laravel Class Loader
|--------------------------------------------------------------------------
|
| In addition to using Composer, you may use the Laravel class loader to
| load your controllers and models. This is useful for keeping all of
| your classes in the "global" namespace without Composer updating.
|
*/

ClassLoader::addDirectories(array(

	app_path().'/commands',
	app_path().'/controllers',
	app_path().'/models',
	app_path().'/database/seeds',

));

/*
|--------------------------------------------------------------------------
| Application Error Logger
|--------------------------------------------------------------------------
|
| Here we will configure the error logger setup for the application which
| is built on top of the wonderful Monolog library. By default we will
| build a basic log file setup which creates a single file for logs.
|
*/

Log::useFiles(storage_path().'/logs/laravel.log');

/*
|--------------------------------------------------------------------------
| Application Error Handler
|--------------------------------------------------------------------------
|
| Here you may handle any errors that occur in your application, including
| logging them or displaying custom views for specific errors. You may
| even register several error handlers to handle different types of
| exceptions. If nothing is returned, the default error view is
| shown, which includes a detailed stack trace during debug.
|
*/

App::error(function(Exception $exception, $code)
{
	Log::error($exception);
});

/*
|--------------------------------------------------------------------------
| Maintenance Mode Handler
|--------------------------------------------------------------------------
|
| The "down" Artisan command gives you the ability to put an application
| into maintenance mode. Here, you will define what is displayed back
| to the user if maintenance mode is in effect for the application.
|
*/

App::down(function()
{
	return Response::make("Be right back!", 503);
});

/*
|--------------------------------------------------------------------------
| Require The Filters File
|--------------------------------------------------------------------------
|
| Next we will load the filters file for the application. This gives us
| a nice separate location to store our route and application filter
| definitions instead of putting them all in the main routes file.
|
*/

require app_path().'/filters.php';
define('TIMEZONE','UP8');
function now()
{
    $now = time();
    $system_time = mktime(gmdate("H", $now), gmdate("i", $now), gmdate("s", $now), gmdate("m", $now), gmdate("d", $now), gmdate("Y", $now));

    if (strlen($system_time) < 10)
    {
        $system_time = time();
        Log::error('Could not set a proper GMT timestamp so the local time() value was used.');
    }
    return $system_time;
}

function gmt_to_local($time = '', $timezone = TIMEZONE, $dst = FALSE)
{
    if ($time == '')
    {
        return now();
    }

    $time += timezones($timezone) * 3600;

    if ($dst == TRUE)
    {
        $time += 3600;
    }

    return $time;
}

function local_to_gmt($time = '')
{
    if ($time == '')
        $time = time();
    return mktime( gmdate("H", $time), gmdate("i", $time), gmdate("s", $time), gmdate("m", $time), gmdate("d", $time), gmdate("Y", $time));
}

function timezones($tz = '')
{
    // Note: Don't change the order of these even though
    // some items appear to be in the wrong order
    $zones = array(
                    'UM12'      => -12,
                    'UM11'      => -11,
                    'UM10'      => -10,
                    'UM95'      => -9.5,
                    'UM9'       => -9,
                    'UM8'       => -8,
                    'UM7'       => -7,
                    'UM6'       => -6,
                    'UM5'       => -5,
                    'UM45'      => -4.5,
                    'UM4'       => -4,
                    'UM35'      => -3.5,
                    'UM3'       => -3,
                    'UM2'       => -2,
                    'UM1'       => -1,
                    'UTC'       => 0,
                    'UP1'       => +1,
                    'UP2'       => +2,
                    'UP3'       => +3,
                    'UP35'      => +3.5,
                    'UP4'       => +4,
                    'UP45'      => +4.5,
                    'UP5'       => +5,
                    'UP55'      => +5.5,
                    'UP575'     => +5.75,
                    'UP6'       => +6,
                    'UP65'      => +6.5,
                    'UP7'       => +7,
                    'UP8'       => +8,
                    'UP875'     => +8.75,
                    'UP9'       => +9,
                    'UP95'      => +9.5,
                    'UP10'      => +10,
                    'UP105'     => +10.5,
                    'UP11'      => +11,
                    'UP115'     => +11.5,
                    'UP12'      => +12,
                    'UP1275'    => +12.75,
                    'UP13'      => +13,
                    'UP14'      => +14
                );

    if ($tz == '')
    {
        return $zones;
    }
    $tz = strtoupper($tz);
    if ($tz == 'GMT')
        $tz = 'UTC';
    return ( ! isset($zones[$tz])) ? 0 : $zones[$tz];
}

function utf8_strcut($str, $length, $start=0)
{
    preg_match_all('/./us', $str, $match);  
    $chars = is_null($length)? array_slice($match[0], $start ) : array_slice($match[0], $start, $length);  
    unset($str);
    return implode('', $chars);
}

/*
|--------------------
| 注册自定义的验证器扩展
|--------------------
*/
Validator::resolver(function($translator, $data, $rules, $messages)
{
    return new CustomValidator($translator, $data, $rules, $messages);
});