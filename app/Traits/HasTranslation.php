<?php

namespace App\Traits;

trait HasTranslation
{
    public function trans($key)
    {
        return $this->{$key . '_' . get_lang()};
    }
}
