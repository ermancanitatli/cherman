<?php

use Phalcon\Debug\Dump;

if (!function_exists('dd')) {

    function dd()
    {
        array_map(function ($x) {
            $string = (new Dump(null, true))->variable($x);
            echo (PHP_SAPI == 'cli' ? strip_tags($string) . PHP_EOL : $string);
        }, func_get_args());

        die;
    }
}

if (!function_exists('base_path')) {

    function base_path($path = null)
    {
        return BASE . '/' . $path;
    }
}

if (!function_exists('app_path')) {

    function app_path($path = null)
    {
        return BASE_APP . '/' . $path;
    }
}

if (!function_exists('config_path')) {

    function config_path($path = null)
    {
        return base_path('config/' . $path);
    }
}

if (!function_exists('storage_path')) {

    function storage_path($path = null)
    {
        return base_path('storage/' . $path);
    }
}

if (!function_exists('cache_path')) {

    function cache_path($path = null)
    {
        return storage_path('cache/' . $path);
    }
}

if (!function_exists('log_path')) {

    function log_path($path = null)
    {
        return storage_path('logs/' . $path);
    }
}

if (!function_exists('public_path')) {

    function public_path($path = null)
    {
        return base_path('public/' . $path);
    }
}