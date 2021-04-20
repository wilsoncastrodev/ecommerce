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
