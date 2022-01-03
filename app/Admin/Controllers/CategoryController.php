<?php

namespace App\Admin\Controllers;

use App\Constants\AppConstants;
use App\Helpers\Select2;
use App\Http\Controllers\Controller;
use App\Models\Category;
use Encore\Admin\Admin;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class CategoryController extends Controller
{

    protected $description = [];
    protected $title = 'Danh mục';

    public function index(Content $content, Category $category, Request $request)
    {
        $grid = new Grid($category);

        $grid->selector(function (Grid\Tools\Selector $selector) {
            $selector->select('type', __('Type'), AppConstants::CATEGORY_TYPES);
        });
        $grid->filter(function (Grid\Filter $filter) {
            $filter->like('title_vi', __('Title vi'));
        });
        $grid->column('id', __('Id'))->sortable();
        $grid->column('title_vi', __('Title vi'));
        $grid->column('type', __('Type Category'))->using(AppConstants::CATEGORY_TYPES);
        $grid->column('thumbnail', __('Thumbnail'))->image('', 100, 100);
        $grid->column('parent.title_vi', __('Parent'))->label('info');
        $grid->column('is_active', __('Is active'))->switch();
        $grid->column('created_at', __('Created at'))->display(function () {
            return $this->created_at->format('Y-m-d');
        });

        return $content
            ->title($this->title)
            ->description($this->description['index'] ?? __('admin.index'))
            ->body($grid);
    }


    public function show(Category $category, Content $content)
    {
        return $content
            ->title($this->title)
            ->description(trans('admin.show'))
            ->body($this->detail($category));
    }

    public function create(Content $content, $type = '')
    {
        return $content
            ->title($this->title)
            ->description($this->description['create'] ?? trans('admin.create'))
            ->body($this->form($type));
    }

    public function store()
    {
        return $this->form()->store();
    }

    protected function detail(Category $category)
    {
        $show = new Show($category);

        $show->field('id', __('Id'));
        $show->field('title_vi', __('Title vi'));
        $show->field('title_en', __('Title en'));
        $show->field('desc_vi', __('Desc vi'));
        $show->field('desc_en', __('Desc en'));
        $show->field('type', __('Type Category'));
        $show->field('thumbnail', __('Thumbnail'));
        $show->field('parent_id', __('Parent id'));
        $show->field('is_active', __('Is active'));
        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));

        return $show;
    }

    public function select2(Request $request, $type = '')
    {
        if (!empty($type)) {
            $query = Category::where('type', $type);
        } else {
            $query = new Category();
        }
        return (new Select2($query))->ajax();
    }

    public function update($id)
    {
        return $this->form()->update($id);
    }

    public function edit(Content $content, $id = '', $type = '')
    {
        return $content
            ->title($this->title)
            ->description($this->description['edit'] ?? trans('admin.edit'))
            ->body($this->form()->edit($id));
    }

    protected function form()
    {
        $category = new Category();
        $form = new Form($category);
        $id = \request()->route('category');
        $form->text('title_vi', __('Title vi'))->rules('required');
        $form->image('thumbnail', __('Thumbnail'))->rules('sometimes');
        $form->image('logo', __('Logo'))->rules('sometimes');
        $form->select('type')->options(AppConstants::CATEGORY_TYPES)->rules([
            'required',
            Rule::in(array_keys(AppConstants::CATEGORY_TYPES))
        ])->default(AppConstants::CATEGORY_TYPE_DEFAULT);

        $form->select('parent_id', __('Parent'))->options(function ($id) {
            return (new Select2(Category::class))->show($id);
        })->ajax(route('admin.categories.select2'))->rules('sometimes');

        $form->switch('is_active', __('Is active'))->rules([
            'required'])->default(1);

        $form->textarea('desc_vi', __('Desc vi'))->rules('sometimes');

        // en
        $form->html('<hr>');
        $form->text('title_en', __('Title en'))->rules('sometimes');
        $form->textarea('desc_en', __('Desc en'))->rules('sometimes');

        Admin::appendJs(fn_get_js_page_url('category'));
        return $form;
    }
}
