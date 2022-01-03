<?php

namespace App\Admin\Controllers;

use App\Admin\Traits\HasCreate;
use App\Admin\Traits\HasEdit;
use App\Http\Controllers\Controller;
use App\Models\Post;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;

class PostController extends Controller
{
    use HasCreate;
    use HasEdit;

    protected $title = 'Post';

    protected $model = 'Post::class';

    protected $description = [
        'index' => 'Index',
        'show' => 'Show',
        'edit' => 'Edit',
        'create' => 'Create',
    ];

    public function index(Content $content, Post $post)
    {
        $grid = new Grid($post);

        $grid->column('id', __('Id'));
        $grid->column('title_vi', __('Title vi'));
        $grid->column('thumbnail', __('Thumbnail'))->image('', 100, 100);
        $grid->column('is_active', __('Is active'))->switch();
        $grid->column('created_at', __('Created at'))->showDate();
        $grid->column('updated_at', __('Updated at'))->showDate();

        return $content
            ->title(trans('Category'))
            ->description(trans('admin.list'))
            ->body($grid);
    }

    protected function detail(Post $post)
    {
        $show = new Show($post);

        $show->field('id', __('Id'));
        $show->field('title_vi', __('Title vi'));
        $show->field('title_en', __('Title en'));
        $show->field('desc_vi', __('Desc vi'));
        $show->field('desc_en', __('Desc en'));
        $show->field('content_vi', __('Content vi'));
        $show->field('content_en', __('Content en'));
        $show->field('thumbnail', __('Thumbnail'));
        $show->field('parent_id', __('Parent id'));
        $show->field('is_active', __('Is active'));
        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));

        return $show;
    }

    protected function form()
    {
        $post = new Post();
        $form = new Form($post);

        $form->text('title_vi', __('Title vi'))->rules('required|max:255');
        $form->image('thumbnail', __('Thumbnail'));
        $form->switch('is_active', __('Is active'))->default(1);
        $form->textarea('desc_vi', __('Desc vi'))->rules('sometimes');
        $form->editor('content_vi', __('Content vi'));

        $form->html('<hr>');
        $form->text('title_en', __('Title en'));

        $form->textarea('desc_en', __('Desc en'));

        $form->editor('content_en', __('Content en'));


        return $form;
    }
}
