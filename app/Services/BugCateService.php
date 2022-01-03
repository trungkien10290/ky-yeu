<?php

namespace App\Services;

use App\Models\Category;

class BugCateService
{
    public function getCategroy()
    {
        return Category::where('type','bug')->active()->get();
    }

    public function getCategroyOther()
    {
        return Category::where('type','other')->active()->get();
    }
}
