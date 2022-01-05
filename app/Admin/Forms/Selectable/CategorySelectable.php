<?php

namespace App\Admin\Forms\Selectable;

use App\Constants\AppConstants;
use App\Models\Bug;
use App\Models\Category;
use Encore\Admin\Grid\Filter;
use Encore\Admin\Grid\Selectable;

class CategorySelectable extends Selectable
{
    public $model = Category::class;
    public static $query;

    public function make()
    {

        $this->column('id');
        $this->column('title_vi', 'Tên danh mục');
        $this->column('type', 'Loại danh mục')->using(AppConstants::CATEGORY_TYPES);
        $this->filter(function (Filter $filter) {
            $filter->like('title_vi');
            $filter->equal('type')->select(AppConstants::CATEGORY_TYPES);
        });
    }
}
