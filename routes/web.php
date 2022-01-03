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
        Route::get('/bugs', [\App\Http\Controllers\BugController::class, 'index'])->name('bug.index');
        Route::get('/bugs/{bug}/modal', [\App\Http\Controllers\BugController::class, 'modal'])->name('bug.modal');
    }
);
