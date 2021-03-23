<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{


    protected static $repositories = [
        'menu' => [
            \App\Repositories\Menu\MenuRepositoryInterface::class,
            \App\Repositories\Menu\MenuRepository::class
        ],
        'category' => [
            \App\Repositories\Category\CategoryRepositoryInterface::class,
            \App\Repositories\Category\CategoryRepository::class
        ],
        'post' => [
            \App\Repositories\Post\PostRepositoryInterface::class,
            \App\Repositories\Post\PostRepository::class
        ],
        'comment' => [
            \App\Repositories\Comment\CommentRepositoryInterface::class,
            \App\Repositories\Comment\CommentRepository::class
        ],
        'tag' => [
            \App\Repositories\Tag\TagRepositoryInterface::class,
            \App\Repositories\Tag\TagRepository::class
        ],
        'account' => [
            \App\Repositories\Account\AccountRepositoryInterface::class,
            \App\Repositories\Account\AccountRepository::class
        ],
        'role' => [
            \App\Repositories\Role\RoleRepositoryInterface::class,
            \App\Repositories\Role\RoleRepository::class
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
