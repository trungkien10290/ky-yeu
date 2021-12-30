<?php

namespace App\Services;

use App\Constants\AppConstants;
use App\Models\Category;

class CategoryService
{
    public function homeList()
    {
        return Category::where('type', AppConstants::CATEGORY_TYPE_PROJECT)->with('projects')->get()->map(function ($category) {
            $category->setRelation('projects', $category->projects->take(6));
            return $category;
        });
    }

    public function bugCategory()
    {
        return Category::where('type', AppConstants::CATEGORY_TYPE_BUG)->get();
    }
}