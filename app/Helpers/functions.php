<?php

use Illuminate\Support\Str;

if (!function_exists('fn_admin')) {
    function fn_admin()
    {
        return Admin::user();
    }
}

if (!function_exists('fn_get_class_plural')) {
    function fn_get_class_plural($class)
    {
        return Str::lower(Str::plural(class_basename($class)));
    }
}

