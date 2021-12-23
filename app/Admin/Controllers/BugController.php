<?php

namespace App\Admin\Controllers;

use App\Admin\Traits\HasCreate;
use App\Admin\Traits\HasEdit;
use App\Constants\AppConstants;
use App\Helpers\Select2;
use App\Http\Controllers\Controller;
use App\Models\Bug;
use App\Models\Category;
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
        $grid->column('projectCategory.title_vi', __('Project category'));
        $grid->column('otherCategory.title_vi', __('Other category'));
        $grid->column('bugCategory.title_vi', __('Bug category'));
        $grid->column('code', __('Code'));
        $grid->column('date', __('Date'));
        $grid->column('is_active', __('Is active'))->switch();
        $grid->column('created_at', __('Created at'))->showDate();
        $grid->column('updated_at', __('Updated at'))->showDate();

        return $content
            ->title(trans('Category'))
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
        $show->field('code', __('Code'));
        $show->field('date', __('Date'));
        $show->field('desc_vi', __('Desc vi'));
        $show->field('desc_en', __('Desc en'));
        $show->field('reason', __('Reason'));
        $show->field('consequence', __('Consequence'));
        $show->field('is_active', __('Is active'));
        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));
        return $show;
    }

    public function show(Content $content,Bug $bug)
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
        $form->select('project_category_id', __('Project category'))
            ->options(Category::where('type',AppConstants::CATEGORY_TYPE_PROJECT)->pluck('title_vi','id'))->rules('required');
        $form->select('other_category_id', __('Project category'))
            ->options(Category::where('type',AppConstants::CATEGORY_TYPE_OTHER)->pluck('title_vi','id'))->rules('required');
        $form->select('bug_category_id', __('Project category'))
            ->options(Category::where('type',AppConstants::CATEGORY_TYPE_BUG)->pluck('title_vi','id'))->rules('required');
        $form->switch('is_active', __('Is active'))->default(1);
        $form->text('code', __('Code'))->disable();
        $form->date('date', __('Date'))->default(date('Y-m-d'));
        $form->multipleFile('desc_vi', __('Desc vi'));
        $form->editor('reason_vi', __('Reason vi'));
        $form->editor('consequence_vi', __('Consequence vi'));

        $form->html('<hr>');
        $form->textarea('desc_en', __('Desc en'));
        $form->editor('reason_en', __('Reason en'));
        $form->editor('consequence_en', __('Consequence en'));

        $form->saving(function(Form $form){
            dd($form->da);
        });
        return $form;
    }

}
