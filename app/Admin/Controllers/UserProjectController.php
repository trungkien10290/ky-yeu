<?php

namespace App\Admin\Controllers;

use App\Admin\Traits\HasCreate;
use App\Admin\Traits\HasEdit;
use App\Constants\AppConstants;
use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\UserProject;
use Encore\Admin\Auth\Database\Administrator;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;
use Illuminate\Validation\Rule;

class UserProjectController extends Controller
{
    use HasCreate;
    use HasEdit;

    protected $title = 'Nhóm quyền dự án';

    protected $model = UserProject::class;


//    protected $description = [
//        'index' => 'Index',
//        'show' => 'Show',
//        'edit' => 'Edit',
//        'create' => 'Create',
//    ];

    public function index(Content $content, UserProject $userProject)
    {
        $grid = new Grid($userProject);
        $grid->column('user.name', 'Admin');

        $grid->filter(function (Grid\Filter $filter) {
            $filter->disableIdFilter();
            $filter->equal('user_id', 'Admin')->select(Administrator::all()->pluck('name', 'id'));
            $filter->equal('project_id', 'Dự án')->select(Project::all()->pluck('title_vi', 'id'));
        });
        $grid->column('project.title_vi', 'Dự án')->style('width:40%');
        $grid->column('permissions', 'Quyền')->label(AppConstants::PROJECT_PERMISSIONS_LABEL);
        return $content
            ->title($this->title)
            ->description($this->description['index'] ?? trans('admin.list'))
            ->body($grid);
    }

    public function show(Content $content, UserProject $userProject)
    {

        return $content
            ->title($this->title)
            ->description($this->description['show'] ?? trans('admin.show'))
            ->body($this->detail($userProject));
    }


    protected function detail(UserProject $userProject)
    {
        $show = new Show($userProject);


        return $show;
    }

    public function create(Content $content)
    {
        return $content
            ->title($this->title)
            ->description($this->description['create'] ?? trans('admin.create'))
            ->body($this->form());
    }


    protected function form()
    {
        $userProject = new UserProject();
        $form = new Form($userProject);

        $form->select('user_id', 'Admin')->options(Administrator::where('id', '!=', fn_admin()->id)->get()->pluck('name', 'id'))->rules('required');
        $form->select('project_id', 'Dự án')->options(Project::all()->pluck('title_vi', 'id'))
            ->rules(['required', Rule::unique('admin_user_projects')->where(function ($query) {
                $id = \request()->route('user_project');

                $query->where('user_id', request('user_id'))->where('project_id', request('project_id'));
                if (!empty($id)) {
                    $query->where('id', '!=', $id);
                }
            })]);

        $form->multipleSelect('permissions')->options(AppConstants::PROJECT_PERMISSIONS)->rules('required');

        return $form;
    }
}
