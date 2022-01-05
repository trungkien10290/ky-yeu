<?php

namespace App\Helpers;

use Illuminate\Support\Arr;

class Seo
{
    private static $options = [];

    public static function setting(array $options)
    {
        self::$options = $options;
    }

    public static function title()
    {
        return Arr::get(self::$options, 'title') ?? setting()->trans('seo_title');
    }

    public static function thumbnail()
    {
        $image =  Arr::get(self::$options, 'thumbnail') ?? setting()->get('logo');
        return image($image);
    }

    public static function description()
    {
        return Arr::get(self::$options, 'description') ?? setting()->trans('seo_description');
    }

    public static function keyword()
    {
        return Arr::get(self::$options, 'keyword') ?? setting()->trans('seo_keyword');
    }
    public static function favicon()
    {
        $image =  Arr::get(self::$options, 'favicon') ?? setting()->get('favicon');
        return image($image);
    }
}
