<?php

namespace App\Admin\Controllers;

use App\Admin\Traits\HasCreate;
use App\Admin\Traits\HasEdit;
use App\Constants\AppConstants;
use App\Http\Controllers\Controller;
use App\Models\Bug;
use App\Models\Category;
use App\Models\Project;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;

class BugController extends Controller
{
    use HasCreate;
    use HasEdit;

    protected $title = 'Bug';

    protected $model = 'Bug::class';

    protected $description = [
        'index' => 'Index',
        'show' => 'Show',
        'edit' => 'Edit',
        'create' => 'Create',
    ];

    public function index(Content $content, Bug $bug)
    {
        $grid = new Grid($bug);

        $grid->column('id', __('Id'));
        $grid->column('category.title_vi', __('Category'));
        $grid->column('project.title_vi', __('Project'));
        $grid->column('desc_vi', __('Desc bug vi'));
        $grid->column('comments_count', __('Comments count'));
        $grid->column('date', __('Date'));
        $grid->column('is_active', __('Is active'))->switch();
        $grid->column('created_at', __('Created at'))->showDate();
        $grid->column('updated_at', __('Updated at'))->showDate();

        return $content
            ->title(trans('Bug'))
            ->description(trans('admin.list'))
            ->body($grid);
    }

    protected function detail(Bug $bug)
    {
        $show = new Show($bug);

        $show->field('id', __('Id'));
        $show->field('project_category_id', __('Project category id'));
        $show->field('other_category_id', __('Other category id'));
        $show->field('bug_category_id', __('Bug category id'));
//        $show->field('code', __('Code'));
        $show->field('date', __('Date'));
        $show->field('desc_vi', __('Desc bug vi'));
        $show->field('desc_en', __('Desc bug en'));
        $show->field('reason', __('Reason'));
        $show->field('consequence', __('Consequence'));
        $show->field('is_active', __('Is active'));
        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));
        return $show;
    }

    public function show(Content $content, Bug $bug)
    {

        return $content
            ->title($this->title)
            ->description($this->description['show'] ?? trans('admin.show'))
            ->body($this->detail($bug));
    }

    protected function form()
    {
        $bug = new Bug();
        $form = new Form($bug);
        $id = request()->route()->parameter('bug');
        $form->select('project_id', __('Project'))->options(Project::all()->pluck('title_vi', 'id'))->rules('required');

        $form->select('category_id', __('Category'))
            ->options(Category::all()->pluck('title_vi', 'id'))->rules('required');

        $form->switch('is_active', __('Is active'))->default(1);
//        $form->text('code', __('Code'))->disable();

        $form->textarea('desc_vi', __('Desc bug vi'));
        $form->multipleImage('bug_images',__('Bug images'))->removable();
        $form->multipleFile('bug_files', __('Bug files'))->removable()->move('bugs')
            ->rules(AppConstants::UPLOAD_FILE_RULES)
            ->accept()
            ->creationRules('required');

        $form->date('date', __('Date'))->default(date('Y-m-d'));
        $form->textarea('reason_vi', __('Reason vi'));
        $form->textarea('consequence_vi', __('Consequence vi'));

        $form->textarea('solution_vi', __('Solution vi'));
        $form->multipleImage('solution_images',__('Solution images'))->removable();
        $form->multipleFile('solution_files', __('Solution files'))->removable()->move('solutions')
            ->rules(AppConstants::UPLOAD_FILE_RULES)
            ->accept()
            ->creationRules('required');

        $form->html('<hr>');
        $form->textarea('desc_en', __('Desc bug en'));
        $form->textarea('reason_en', __('Reason en'));
        $form->textarea('consequence_en', __('Consequence en'));
        $form->textarea('solution_en', __('Solution en'));
        $form->saving(function (Form $form) {
        });

        return $form;
    }

}
