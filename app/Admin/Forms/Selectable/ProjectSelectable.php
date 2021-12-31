<?php

namespace App\Admin\Forms\Selectable;

use App\Models\Project;
use Encore\Admin\Grid\Filter;
use Encore\Admin\Grid\Selectable;
use Encore\Admin\Grid\Tools;
use Illuminate\Support\Arr;

class ProjectSelectable extends Selectable
{
    public $model = Project::class;

    public function make()
    {
        $this->column('id');
        $this->column('title_vi');
        $this->filter(function (Filter $filter) {
            $filter->like('title_vi');
        });

    }
    public function renderFormGrid($values)
    {

        $this->make();
        $this->column('project_permission_create','Thêm')->switch();
        $this->column('project_permission_edit','Sửa')->switch();
        $this->column('project_permission_delete','Xóa')->switch();
//        $this->column('bugs')->belongsToMany(BugSelectable::class);
        $this->appendRemoveBtn(false);
        $this->model()->whereKey(Arr::wrap($values));

        $this->disableFeatures()->disableFilter();
        $this->tools(function (Tools $tools) {
            $tools->append(new Selectable\BrowserBtn());
        });
        return $this->grid;
    }


}
