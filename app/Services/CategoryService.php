<?php

namespace App\Services;

use App\Constants\AppConstants;
use App\Models\Category;

class CategoryService
{

    public function bugCategory()
    {
        return Category::where('type', AppConstants::CATEGORY_TYPE_BUG)->active()->get();
    }

    public function otherCategory()
    {
        return Category::where('type', AppConstants::CATEGORY_TYPE_OTHER)->active()->get();
    }
}
