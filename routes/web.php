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
        Route::post('/addComment/{id}', 'CommentController')->name('addComment');
    });

    Route::namespace('Category')->prefix('category')->name('category.')->group(function () {
        Route::get('/{name_route}', 'CategoryController')->name('index');
    });

    Route::namespace('Tag')->prefix('tag')->name('tag.')->group(function () {
        Route::get('/{name}', 'TagController')->name('index');
    });

    Route::prefix('search')->group(function () {
        Route::get('/', 'SearchController')->name('search');
    });

    Route::get('/home', function () {
        return view('frontend.home2');
    });
});

require __DIR__ . '/auth.php';
