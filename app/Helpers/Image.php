<?php

namespace App\Helpers;

class Image
{

    public static function show($image)
    {

        if (filter_var($image, FILTER_VALIDATE_URL)) {
            return $image;
        }
        return cloud_url($image);
    }
}
