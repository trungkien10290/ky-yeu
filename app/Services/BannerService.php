<?php

namespace App\Services;

use App\Constants\AppConstants;
use App\Models\Banner;

class BannerService
{
    public function homeList()
    {
        return Banner::active()->get();
    }

}
