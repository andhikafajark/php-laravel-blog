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
use Modules\Pages\Http\Controllers\PagesController;

// Pages
Route::name('pages.')->group(function () {
    Route::get('/blog/{blog:slug}', [PagesController::class, 'blog'])->name('blog');
});
