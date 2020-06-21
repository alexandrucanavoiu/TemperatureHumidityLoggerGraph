<?php

namespace App\Helpers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;

class Navigation
{
    public static function isActiveRoute($routes, $output = 'active')
    {
        if (!is_array($routes)) {
            $routes = [$routes];
        }
        foreach ($routes as $route) {
            if (Route::currentRouteName() == $route) {
                return $output;
            }
        }
        return ''; // Route is not active, return default result
    }

    public static function generateRandomString($length = 4) {
        $characters = '0123456789';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }


}
