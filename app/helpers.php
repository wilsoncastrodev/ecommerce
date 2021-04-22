<?php

use Illuminate\Support\Str;

if (!function_exists('storeImages')) {
    function storeImages($images, $type, $name)
    {
        $i = 0;
        foreach ($images as $image) {
            $file_name = Str::slug($name) . $i . '_' . time() . '.' . $image->getClientOriginalExtension();
            $path[] = $image->storeAs('public/imagens/' . $type, $file_name);
            $i++;
        }

        return $path;
    }
}

if (!function_exists('getRealCustomerIp')) {
    function getRealCustomerIp()
    {
        switch (true) {
            case (!empty($_SERVER['HTTP_X_REAL_IP'])):
                return $_SERVER['HTTP_X_REAL_IP'];
            case (!empty($_SERVER['HTTP_CLIENT_IP'])):
                return $_SERVER['HTTP_CLIENT_IP'];
            case (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])):
                return $_SERVER['HTTP_X_FORWARDED_FOR'];
            default:
                return $_SERVER['REMOTE_ADDR'];
        }
    }
}
