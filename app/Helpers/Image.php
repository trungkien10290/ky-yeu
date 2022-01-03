<?php

namespace App\Helpers;

class Image
{
    const NO_IMAGE = 'noimage.jpg';

    public static function show($image, $size = null)
    {
        if (strpos($image, 'http') !== false) {
            return $image;
        }
        if (!empty($image) && file_exists(public_path($image))) {
            return asset($image);
        } else {
            return asset(self::NO_IMAGE);
        }
    }

    public static function thumbs($image)
    {
        if (strpos($image, 'http') !== false) {
            return $image;
        }
        if (file_exists(public_path($image))) {
            $folder = $image = explode('/', $image);
            $imageName = array_pop($folder);
            $thumb = implode('/', $folder) . '/' . 'thumbs/' . $imageName;
            if (file_exists(public_path($thumb))) {
                $image = $thumb;
            }
            return asset($image);
        } else {
            return asset(self::NO_IMAGE);
        }
    }
}
