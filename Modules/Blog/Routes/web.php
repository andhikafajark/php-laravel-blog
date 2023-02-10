<?php

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

use Illuminate\Support\Facades\Route;
use Modules\Blog\Http\Controllers\BlogController;

Route::prefix('admin')->group(function () {
    // Blog
    Route::name('blog.')->group(function () {
        Route::match(['put', 'patch'], 'blog/{blog}/comment', [BlogController::class, 'comment'])->name('comment');
    });
    Route::resource('blog', BlogController::class, [
        'except' => ['show']
    ]);
});
