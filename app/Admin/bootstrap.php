<?php

/**
 * Laravel-admin - admin builder based on Laravel.
 * @author z-song <https://github.com/z-song>
 *
 * Bootstraper for Admin.
 *
 * Here you can remove builtin form field:
 * Encore\Admin\Form::forget(['map', 'editor']);
 *
 * Or extend custom form field:
 * Encore\Admin\Form::extend('php', PHPEditor::class);
 *
 * Or require js and css assets:
 * Admin::css('/packages/prettydocs/css/styles.css');
 * Admin::js('/packages/prettydocs/js/main.js');
 *
 */

use Encore\Admin\Admin;
use Encore\Admin\Form;
use Encore\Admin\Grid;

//Form::forget(['map', 'editor']);
Admin::css(url('vendor/laravel-admin/custom.css'));
Form::extend('editor', \App\Admin\Extensions\Form\CKEditor::class);


Grid::init(function (Grid $grid) {

//    $grid->disableActions();

    $grid->disableRowSelector();

    $grid->disableColumnSelector();
    $class = fn_get_class_plural($grid->model()->getOriginalModel());
//    $grid->disableTools();
    if (fn_admin()->cannot($class . \App\Constants\AppConstants::PERMISSION_CREATE)) {
        $grid->disableCreateButton();
    }
    if (fn_admin()->cannot($class . \App\Constants\AppConstants::PERMISSION_CREATE)) {
        $grid->disableCreateButton();
    }
    $grid->disableExport();
    $grid->actions(function (Grid\Displayers\Actions $actions) use ($class) {
        $actions->disableView();
        if (fn_admin()->cannot($class . \App\Constants\AppConstants::PERMISSION_DELETE)) {
            $actions->disableDelete();
        }
        if (fn_admin()->cannot($class . \App\Constants\AppConstants::PERMISSION_EDIT, $actions->row)) {
            $actions->disableEdit();
        }
    });

});


Form::init(function (Form $form) {
    $form->disableCreatingCheck();
    $form->disableEditingCheck();
    $form->disableViewCheck();
    $form->disableReset();
    $form->tools(function (Form\Tools $tools){
        $tools->disableView();
    });
});

\Encore\Admin\Show::init(function (\Encore\Admin\Show $show) {
    $show->panel()->tools(function ($tools) {
        $tools->disableDelete();
    });
});
