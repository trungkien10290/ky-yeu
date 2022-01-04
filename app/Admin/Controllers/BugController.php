<?php

namespace App\Admin\Controllers;

use App\Admin\Forms\Selectable\CategorySelectable;
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
        if (!is_super_admin()) {
            $grid->model()->projectOwner();
        }

        $grid->filter(function (Grid\Filter $filter) {

            $filter->where(function ($query) {
                return $query->whereHas('category', function ($query) {
                    return $query->where('type', $this->input);
                });
            }, 'Loại danh mục')->select(AppConstants::CATEGORY_TYPES);
            $filter->equal('category_id', 'Danh mục')->select(Category::all()->pluck('title_vi', 'id'));
            $filter->equal('project_id', 'Dự án')->select(Project::getAllCanView()->pluck('title_vi', 'id'));
        });

        $grid->column('id', __('Id'));
        $grid->column('category.title_vi', __('Category'));
        $grid->column('category.type', __('Loại danh mục'));
        $grid->column('project.title_vi', __('Project'));
        $grid->column('desc_vi', __('Desc bug vi'));
        $grid->column('comments_count', __('Comments count'));
        $grid->column('date', __('Date'));
        $grid->column('is_active', __('Is active'))->switch();
        $grid->column('created_at', __('Created at'))->showDate();
        $grid->column('updated_at', __('Updated at'))->showDate();

        $grid->actions(function (Grid\Displayers\Actions $actions) {
            if (!is_super_admin()) {
                $project = $actions->row->project ?? '';
                if (empty($project) || fn_admin()->cannotProject('edit', $project)) {
                    $actions->disableEdit();
                }

                if (empty($project) || fn_admin()->cannotProject('delete', $project)) {
                    $actions->disableDelete();
                }
            }

            $actions->disableView();
        });
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
        $projects = Project::getAllCanView()->pluck('title_vi', 'id');

        if (empty($id)) {
            $form->belongsTo('category_id', CategorySelectable::class, __('Category'))->rules('required');
            $form->select('project_id', __('Project'))->options($projects)->rules([
                function ($attribute, $value, $fail) {
                    $category = Category::select('type')->find(request('category_id'));
                    $type = $category->type ?? '';
                    if (empty(request('project_id')) && $type === AppConstants::CATEGORY_TYPE_BUG) {
                        return $fail('Dự án là bắt buộc nếu chọn danh mục lỗi');
                    }
                }
            ]);
        } else {
            $form->display('project.title_vi', __('Project'))->disable();
            $form->display('category.type', 'Loại danh mục');
            $form->display('category.title_vi', __('Category'))->disable();
        }


        $form->switch('is_active', __('Is active'))->default(1);
//        $form->text('code', __('Code'))->disable();

        $form->textarea('desc_vi', __('Desc bug vi'));
        $form->multipleImage('bug_images', __('Bug images'));
        $form->multipleFile('bug_files', __('Bug files'));
        $form->date('date', __('Date'))->default(date('Y-m-d'));
        $form->textarea('reason_vi', __('Reason vi'));
        $form->textarea('consequence_vi', __('Consequence vi'));
        $form->textarea('solution_vi', __('Solution vi'));
        $form->multipleImage('solution_images', __('Solution images'));
        $form->multipleFile('solution_files', __('Solution files'));
        $form->html('<hr>');
        $form->textarea('desc_en', __('Desc bug en'));
        $form->textarea('reason_en', __('Reason en'));
        $form->textarea('consequence_en', __('Consequence en'));
        $form->textarea('solution_en', __('Solution en'));
        $form->saving(function (Form $form) {
        });

        return $form;
    }

    public function destroy(Bug $bug)
    {
    }
}
