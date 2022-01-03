<?php

namespace App\Admin\Forms\Selectable;

use App\Models\User;
use Encore\Admin\Grid\Filter;
use Encore\Admin\Grid\Selectable;

class UserSelectable extends Selectable
{
    public $model = User::class;
    public static $query;

    public function make()
    {
        $this->column('id');
        $this->column('name', 'Tên dự án');
        $this->filter(function (Filter $filter) {
            $filter->like('name');
        });
    }
}
