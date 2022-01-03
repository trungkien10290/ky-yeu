<?php

namespace App\Admin\Forms\Selectable;

use App\Models\Bug;
use Encore\Admin\Grid\Filter;
use Encore\Admin\Grid\Selectable;

class BugSelectable extends Selectable
{
    public $model = Bug::class;
    public static $query;

    public function make()
    {
        $this->column('id');
        $this->column('project.title_vi', 'Tên dự án');
        $this->column('desc_vi');
        $this->filter(function (Filter $filter) {
            $filter->like('desc_vi');
        });
    }
}
