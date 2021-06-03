<?php

use Illuminate\Support\Str;

if (!function_exists('storeImages')) {
    function storeImages($images, $type, $name)
    {
        $i = 0;
        foreach ($images as $image) {
            $file_name = Str::slug($name) . $i . '_' . time() . '.' . $image->getClientOriginalExtension();
            $image->storeAs('public/imagens/' . $type, $file_name);
            $path[] = 'storage/imagens/' . $type . '/' . $file_name;
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

if (!function_exists('formatCurrency')) {
    function formatCurrency($value)
    {
        return number_format($value, 2, ',', '.');
    }
}

if (!function_exists('formatLeadingZero')) {
    function formatLeadingZero($value)
    {
        return str_pad($value, 2, '0', STR_PAD_LEFT);
    }
}

if (!function_exists('limitText')) {
    function limitText($value)
    {
        if (strlen($value) > 80) {
            return substr_replace($value, "...", 80);
        }

        return $value;
    }
}

if (!function_exists('creditCardYears')) {
    function creditCardYears()
    {
        $date_years = range(date("Y"), date("Y") + 15);

        return $date_years;
    }
}

if (!function_exists('creditCardMonths')) {
    function creditCardMonths()
    {
        $date_months = range(1, 12);

        return $date_months;
    }
}

if (!function_exists('removeAllSpaces')) {
    function removeAllSpaces($value)
    {
        return str_replace(' ', '', $value);
    }
}

if (!function_exists('removePointDecimal')) {
    function removePointDecimal($value)
    {
        return str_replace('.', '', number_format($value, 2, '.', ''));
    }
}

if (!function_exists('firstName')) {
    function firstName($value)
    {
        return strtok($value, " ");
    }
}
