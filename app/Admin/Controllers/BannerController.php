<?php

namespace App\Admin\Controllers;

use App\Admin\Traits\HasCreate;
use App\Admin\Traits\HasEdit;
use App\Http\Controllers\Controller;
use App\Models\Banner;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;

class BannerController extends Controller
{
    use HasCreate;
    use HasEdit;

    protected $title = 'Banner';

    protected $model = Banner::class;

//    protected $description = [
//        'index' => 'Index',
//        'show' => 'Show',
//        'edit' => 'Edit',
//        'create' => 'Create',
//    ];

    public function index(Content $content, Banner $banner)
    {
        $grid = new Grid($banner);

        $grid->column('id', __('Id'));
        $grid->column('title_vi', __('Title vi'));
        $grid->column('thumbnail', __('Thumbnail'))->image('', 100, 100);
        $grid->column('is_active',__('Is active'))->switch();

        return $content
            ->title($this->title)
            ->description($this->description['index'] ?? trans('admin.list'))
            ->body($grid);
    }

    public function show(Content $content, Banner $banner)
    {

        return $content
            ->title($this->title)
            ->description($this->description['show'] ?? trans('admin.show'))
            ->body($this->detail($banner));
    }


    protected function detail(Banner $banner)
    {
        $show = new Show($banner);

        $show->field('id', __('Id'));
        $show->field('title_vi', __('Title vi'));
        $show->field('desc_vi', __('Desc vi'));
        $show->field('thumbnail', __('Thumbnail'));
        $show->field('position', __('Position'));
        $show->field('title_en', __('Title en'));
        $show->field('desc_en', __('Desc en'));
        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));

        return $show;
    }

    protected function form()
    {

        $banner = new Banner();
        $form = new Form($banner);
        $form->text('title_vi', __('Title vi'))->rules('required');
        $form->image('thumbnail', __('Thumbnail'));
        $form->file('video', __('Video'))->isVideo();
        $form->textarea('desc_vi', __('Desc vi'));
        $form->switch('is_active',__('Is active'))->default(1);
        $form->html('<hr>');
        $form->text('title_en', __('Title en'));
        $form->textarea('desc_en', __('Desc en'));

        return $form;
    }

}
