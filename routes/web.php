<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('set_lang', function () {
})->name('set_lang');
Route::group(
    ['prefix' => '/{lang?}/', 'where' => ['lang' => 'vi|en']],
    function () {
        Route::get('/', [\App\Http\Controllers\HomeController::class, 'index']);
        Route::get('/login', [\App\Http\Controllers\LogInController::class, 'index'])->name('login.index');
        Route::post('/login', [\App\Http\Controllers\LogInController::class, 'logIn'])->name('login.logIn');
        Route::get('/logout', [\App\Http\Controllers\LogInController::class, 'logOut'])->name('login.logOut');
        Route::get('/project', [\App\Http\Controllers\ProjectController::class, 'show'])->name('project');
        Route::get('/bugs', [\App\Http\Controllers\BugController::class, 'index'])->name('bug.index');
        Route::get('/bugs/{bug}/modal', [\App\Http\Controllers\BugController::class, 'modal'])->name('bug.modal');
    }
);
