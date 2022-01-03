<?php

use Illuminate\Support\Str;

if (!function_exists('fn_admin')) {
    function fn_admin()
    {
        return Admin::user();
    }
}

if (!function_exists('fn_get_class_plural')) {
    function fn_get_class_plural($class): string
    {
        return Str::lower(Str::plural(class_basename($class)));
    }
}

if (!function_exists('fn_get_js_page_url')) {
    function fn_get_js_page_url($fileName): string
    {
        return asset('admins/pages/' . $fileName . '.js');
    }
}
if (!function_exists('get_lang')) {
    function get_lang(): string
    {
        return app()->getLocale();
    }
}

if (!function_exists('count_array')) {
    function count_array($array)
    {
        return is_array($array) ? count($array) : 0;
    }
}


function image($image, $size = '')
{
    return \App\Helpers\Image::show($image, $size);
}
function thumbnail($image)
{
    return \App\Helpers\Image::thumbs($image);
}

function cloud_url($path)
{
    return \Illuminate\Support\Facades\Storage::disk('admin')->url($path);
}
