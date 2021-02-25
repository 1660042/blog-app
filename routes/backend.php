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

Route::group(['middleware' => 'auth', 'as' => 'backend.'], function () {
    Route::get('/', function () {
        return view('backend.home');
    })->name('index');

    // Route::namespace('Category')->group(function () {
    //     Route::get('/categories', 'IndexController')->name('categories');
    // });

    Route::group(['as' => 'posts.'], function () {
        Route::namespace('Category')->prefix('categories')->name('categories.')->group(function () {
            Route::get('/', 'IndexController')->name('index');
            Route::get('/create', 'CreateController')->name('create');
        });
        
        Route::get('/post', function() {
            return view('backend.home');
        })->name('post');
    });

    Route::namespace('Ajax')->name('ajax.')->group(function () {
        Route::post('slug', 'AjaxController@getSlug')->name('slug');
        //Route::get('/create', 'CreateController')->name('create');
    });



    Route::as('accounts.')->group(function () {
        Route::get('/users', function() {
            return view('backend.home');
        })->name('users');
    });

    // Route::get('/post', function() {
    //     return view('backend.home');
    // })->name('post');

    // Route::get('/posts', function() {
    //     return view('backend.home');
    // })->name('posts');

    // Route::get('/users', function() {
    //     return view('backend.home');
    // })->name('users');
});