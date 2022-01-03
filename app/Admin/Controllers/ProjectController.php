<?php

namespace App\Admin\Controllers;

use App\Admin\Traits\HasCreate;
use App\Admin\Traits\HasEdit;
use App\Http\Controllers\Controller;
use App\Models\Project;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;

class ProjectController extends Controller
{
    use HasCreate;
    use HasEdit;

    protected $title = 'Project';

    protected $model = Project::class;

//    protected $description = [
//        'index' => 'Index',
//        'show' => 'Show',
//        'edit' => 'Edit',
//        'create' => 'Create',
//    ];

    public function index(Content $content, Project $project)
    {
        $grid = new Grid($project);
        if (!is_super_admin()) {
            $ownerProject = fn_admin()->projectPermissions->pluck('project_id');
            $grid->model()->whereIn('id', $ownerProject);
        }
        $grid->column('id', __('Id'));
        $grid->column('title_vi', __('Title vi'));
        $grid->column('thumbnail', __('Thumbnail'))->image('', 100, 100);
        $grid->column('is_active', __('Is active'))->switch();
        $grid->column('created_at', __('Created at'))->showDate();
        $grid->column('updated_at', __('Updated at'))->showDate();
        $grid->actions(function (Grid\Displayers\Actions $actions) {
            if (fn_admin()->cannotProject('edit', $actions->row)) {
                $actions->disableEdit();
            }
            if (fn_admin()->cannotProject('delete', $actions->row)) {
                $actions->disableDelete();
            }
            $actions->disableView();
        });
        return $content
            ->title(trans('Project'))
            ->description(trans('admin.list'))
            ->body($grid);
    }

    public function show(Content $content, Project $project)
    {

        return $content
            ->title($this->title)
            ->description($this->description['show'] ?? trans('admin.show'))
            ->body($this->detail($project));
    }


    protected function detail(Project $project)
    {
        $show = new Show($project);

        $show->field('id', __('Id'));
        $show->field('title_vi', __('Title vi'));
        $show->field('title_en', __('Title en'));
        $show->field('type', __('Type'));
        $show->field('desc_vi', __('Desc vi'));
        $show->field('desc_en', __('Desc en'));
        $show->field('content_vi', __('Content vi'));
        $show->field('content_en', __('Content en'));
        $show->field('thumbnail', __('Thumbnail'));
        $show->field('logo', __('Logo'));
        $show->field('parent_id', __('Parent id'));
        $show->field('is_active', __('Is active'));
        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));

        return $show;
    }

    protected function form()
    {
        $project = new Project();
        $form = new Form($project);

        $form->text('title_vi', __('Title vi'))->rules(['required']);
        $form->image('thumbnail', __('Thumbnail'));
        $form->image('logo', __('Logo'));
        $form->switch('is_active', __('Is active'))->default(1);

        $form->textarea('desc_vi', __('Desc vi'));
        $form->editor('content_vi', __('Content vi'));
        $form->html('<hr>');
        $form->text('title_en', __('Title en'));
        $form->textarea('desc_en', __('Desc en'));
        $form->editor('content_en', __('Content en'));

        return $form;
    }
}
