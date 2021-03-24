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

    Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['web', 'auth']], function () {
        \UniSharp\LaravelFilemanager\Lfm::routes();
    });



    Route::group(['as' => 'posts.'], function () {
        Route::namespace('Category')->prefix('categories')->name('categories.')->group(function () {
            Route::get('/', 'IndexController')->name('index');
            Route::get('/create', 'CreateController')->name('create');
            Route::post('/store', 'StoreController')->name('store');
            Route::get('/edit/{id}', 'EditController')->name('edit');
            Route::put('/update/{id}', 'UpdateController')->name('update');
            Route::delete('/delete/{id}', 'DeleteController')->name('delete');
        });

        Route::namespace('Post')->prefix('posts')->name('posts.')->group(function () {
            Route::get('/', 'IndexController')->name('index');
            Route::get('/create', 'CreateController')->name('create');
            Route::post('/store', 'StoreController')->name('store');
            Route::get('/edit/{id}', 'EditController')->name('edit');
            Route::put('/update/{id}', 'UpdateController')->name('update');
            Route::delete('/delete/{id}', 'DeleteController')->name('delete');
        });
    });

    Route::namespace('Ajax')->name('ajax.')->group(function () {
        Route::post('slug', 'AjaxController@getSlug')->name('slug');
        //Route::get('/create', 'CreateController')->name('create');
    });

    Route::namespace('Account')->prefix('accounts')->name('accounts.')->group(function () {
        Route::name('accounts.')->group(function () {
            Route::get('/', 'AccountController@index')->name('index');
            Route::get('/create', 'AccountController@create')->name('create');
            Route::post('/store', 'AccountController@store')->name('store');
            Route::get('/edit/{id}', 'AccountController@edit')->name('edit');
            Route::put('/update/{id}', 'AccountController@update')->name('update');
        });
    });

    Route::namespace('System')->prefix('system')->name('systems.')->group(function () {
        Route::prefix('roles')->name('roles.')->group(function () {
            Route::get('/', 'RoleController@index')->name('index');
            Route::get('/create', 'RoleController@create')->name('create');
            Route::post('/store', 'RoleController@store')->name('store');
            Route::get('/edit/{id}', 'RoleController@edit')->name('edit');
            Route::put('/update/{id}', 'RoleController@update')->name('update');
        });
    });


    // Route::as('accounts.')->group(function () {
    //     Route::get('/users', function () {
    //         return view('backend.home');
    //     })->name('users');
    // });
});
