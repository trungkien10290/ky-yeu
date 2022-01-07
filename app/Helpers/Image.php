<?php

namespace App\Helpers;

class Image
{
    const NO_IMAGE = 'noimage.jpg';

    public static function show($image, $size = null)
    {
        if (url()->isValidUrl($image) || strpos($image, 'data:image') === 0) {
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
        if (!empty($image)) {
            if (url()->isValidUrl($image) || strpos($image, 'data:image') === 0) {
                return $image;
            }
            if (file_exists(public_path($image))) {
//                $folder = $image = explode('/', $image);
                $info = pathinfo($image);
                $thumb = $info['dirname'] . '/' . 'thumbs/' . $info['filename'];
                if (!empty($thumb) && file_exists(public_path($thumb))) {
                    $image = $thumb;
                }

                return asset($image);
            }
        }


        return asset(self::NO_IMAGE);
    }
}
