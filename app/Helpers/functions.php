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
        return asset('admin/pages/' . $fileName . '.js');
    }
}
