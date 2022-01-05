<?php

namespace App\Admin\Controllers;

use App\Admin\Forms\Selectable\BugSelectable;
use App\Admin\Forms\Selectable\UserSelectable;
use App\Admin\Traits\HasCreate;
use App\Admin\Traits\HasEdit;
use App\Http\Controllers\Controller;
use App\Models\Comment;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;

class CommentController extends Controller
{
    use HasCreate;
    use HasEdit;

    protected $title = 'Comment';

    protected $model = Comment::class;

//    protected $description = [
//        'index' => 'Index',
//        'show' => 'Show',
//        'edit' => 'Edit',
//        'create' => 'Create',
//    ];

    public function index(Content $content, Comment $comment)
    {
        $grid = new Grid($comment);
        if (!is_super_admin()) {
            $grid->model()->whereHas('bug', function ($query) {
                return $query->projectOwner();
            });
        }

        $grid->column('id', __('Id'));
        $grid->column('user.name', __('User'));
        $grid->column('bug.desc_vi', __('Bug'));
        $grid->column('content', __('Content'));
        $grid->column('images', __('MultipleImage'))->image('', 100, 100);
        $grid->column('is_active', __('Is active'))->switch();
        $grid->column('created_at', __('Created at'))->showDate();
        $grid->column('updated_at', __('Updated at'))->showDate();

        return $content
            ->title($this->title)
            ->description($this->description['index'] ?? trans('admin.list'))
            ->body($grid);
    }

    public function show(Content $content, Comment $comment)
    {

        return $content
            ->title($this->title)
            ->description($this->description['show'] ?? trans('admin.show'))
            ->body($this->detail($comment));
    }


    protected function detail(Comment $comment)
    {
        $show = new Show($comment);

        $show->field('id', __('Id'));
        $show->field('user_id', __('User id'));
        $show->field('bug_id', __('Bug id'));
        $show->field('content', __('Content'));
        $show->field('images', __('MultipleImage'));
        $show->field('files', __('MultipleFile'));
        $show->field('is_active', __('Is active'));
        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));

        return $show;
    }

    protected function form()
    {
        $comment = new Comment();
        $form = new Form($comment);

        $form->belongsTo('user_id', UserSelectable::class, __('User'))->creationRules('required');
        $form->belongsTo('bug_id', BugSelectable::class, __('Bug'))->creationRules('required');
        $form->textarea('content', __('Content'));
        $form->multipleImage('images', __('MultipleImage'));
        $form->multipleFile('files', __('MultipleFile'));
        $form->switch('is_active', __('Is active'))->default(1);

        return $form;
    }
}
