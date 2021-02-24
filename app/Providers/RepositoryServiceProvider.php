<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{


    protected static $repositories = [
        'menu' => [
            \App\Repositories\Backend\Menu\MenuRepositoryInterface::class,
            \App\Repositories\Backend\Menu\MenuRepository::class
        ],
        'category' => [
            \App\Repositories\Backend\Category\CategoryRepositoryInterface::class,
            \App\Repositories\Backend\Category\CategoryRepository::class
        ],
    ];


    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        foreach (static::$repositories as $repository) {
            $this->app->singleton(
                $repository[0],
                $repository[1]
            );
        }
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
