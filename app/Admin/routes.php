<?php

use App\Admin\Controllers\BugController;
use App\Admin\Controllers\CategoryController;
use App\Admin\Controllers\PostController;
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
    });

    Route::prefix(config('admin.route.prefix') . '_api')->group(function (Router $router) {
        $router->get('categories/select2', [CategoryController::class, 'select2'])->name('categories.select2');
        $router->get('categories/{type}/select2', [CategoryController::class, 'select2'])->name('categories.type.select2');
    });

});
