<?php

use App\Admin\Controllers\BannerController;
use App\Admin\Controllers\BugController;
use App\Admin\Controllers\CategoryController;
use App\Admin\Controllers\CommentController;
use App\Admin\Controllers\PostController;
use App\Admin\Controllers\ProjectController;
use Encore\Admin\Facades\Admin;
use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Route;

Admin::routes();

Route::group([
    'middleware' => config('admin.route.middleware'),
    'as' => config('admin.route.prefix') . '.',
], function () {
    Route::prefix(config('admin.route.prefix'))->group(function (Router $router) {
        $router->get('/', [\App\Admin\Controllers\HomeController::class, 'index'])->name('home');
        $router->resource('categories', CategoryController::class)->whereNumber('category')->except('show');
        $router->resource('posts', PostController::class)->whereNumber('post')->except('show');
        $router->resource('bugs', BugController::class)->whereNumber('bug');
        $router->resource('projects', ProjectController::class)->whereNumber('project');
        $router->resource('banner', BannerController::class)->whereNumber('banner');
        $router->resource('comments', CommentController::class)->whereNumber('comment');
        $router->resource('user_projects', \App\Admin\Controllers\UserProjectController::class)->whereNumber('user_project');
    });

    Route::prefix(config('admin.route.prefix') . '_api')->group(function (Router $router) {
        $router->get('categories/select2', [CategoryController::class, 'select2'])->name('categories.select2');
        $router->get('categories/{type}/select2', [CategoryController::class, 'select2'])->name('categories.type.select2');
    });

});


Route::group([
    'middleware' => config('admin.route.middleware'),
    'prefix' =>'admin/filemanager'
], function () {
    \UniSharp\LaravelFilemanager\Lfm::routes();
});
