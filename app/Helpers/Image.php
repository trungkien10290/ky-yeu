<?php

namespace App\Helpers;

class Image
{
    const NO_IMAGE = 'no-image.png';
    public static function show($image,$size = null)
    {
        if (strpos($image,'http') !== false) {
            return $image;
        }
        if(file_exists(public_path($image))){
            return asset($image);
        }
        else{
            return asset(self::NO_IMAGE) ;
        }
    }
}
