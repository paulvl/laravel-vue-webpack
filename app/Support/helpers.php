<?php

use Illuminate\Container\Container;

if (! function_exists('get_app_namespace')) {
    function get_app_namespace()
    {
        return Container::getInstance()->getNamespace();
    }
}

if (! function_exists('api_token')) {
    function api_token()
    {
        $token = str_random(60);
        $exists = false;
        while(!$exists) {
            $userClass = get_app_namespace() . 'User';
            $user = $userClass::where('api_token', $token)->first();
            if ($user) {
                $token = str_random(60);
            } else {
                $exists = true;
            }
        }
        return $token;
    }
}