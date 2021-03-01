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

Route::namespace('Frontend')->name('frontend.')->group(function () {
    Route::get('/', 'HomeController')->name('home');
    Route::namespace('Post')->prefix('post')->name('post.')->group(function () {
        Route::get('/{slug}', 'PostController')->name('post');
    });
    Route::namespace('Category')->prefix('category')->name('category.')->group(function () {
        Route::get('/{url_page}', 'CategoryController')->name('category');
    });
});

require __DIR__.'/auth.php';
