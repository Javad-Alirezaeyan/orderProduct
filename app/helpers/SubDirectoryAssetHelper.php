<?php

if(!function_exists('subdirAsset')){
    function subdirAsset($path)
    {
        return asset((App::environment('production') ? env('APP_DIR') : '') . "/" . $path);
    }
}
if (!function_exists('subdirMix')) {
    function subdirMix($path)
    {
        return  (url('/')."/".(App::environment('production') ? env('APP_DIR') : ''))  . mix( $path);
    }
}

if (!function_exists('subdirUrl')) {
    function subdirUrl($path, $params= [])
    {
        return url((App::environment('production') ? env('APP_DIR') : '') . "/" . $path, $params);
    }
}
