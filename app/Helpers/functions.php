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

if (!function_exists('image')) {
    function image($image, $size = '')
    {
        return \App\Helpers\Image::show($image, $size);
    }
}
if (!function_exists('thumbnail')) {
    function thumbnail($image)
    {
        return \App\Helpers\Image::thumbs($image);
    }
}
if (!function_exists('lang_change')) {

    function lang_change($lang = null): string
    {
        $lang = $lang ?? get_lang();
        return $lang === 'vi' ? 'en' : 'vi';
    }
}
if (!function_exists('url_change_lang')) {
    function url_change_lang()
    {
        return str_replace(url(get_lang()), url(lang_change()), url()->current());
    }
}
if (!function_exists('public_logo')) {
    function public_logo()
    {
        return setting('logo', 'frontend/images/logo.png');
    }
}

if (!function_exists('base_url_lang')) {
    function base_url_lang($slug = '', $lang = null)
    {
        $lang = $lang ?? get_lang();
        return url($lang . '/' . $slug);
    }
}
if (!function_exists('setting')) {

    function setting($key = null, $default = null)
    {
        if ($key === null) {
            return \App\Helpers\Setting::ins();
        }

        return \App\Helpers\Setting::ins()->get($key, $default);
    }
}
if (!function_exists('string_break_line_to_array')) {

    function string_break_line_to_array($content)
    {
        $contentArray = explode("\n", str_replace("\r", "", $content));
        return array_filter($contentArray, function ($item) {
            return trim($item) !== '';
        });
    }
}

function show_file_name($files)
{
    if (empty($files)) {
        return $files;
    }
    $fileArray = explode('/', $files);
    return array_pop($fileArray);
}
