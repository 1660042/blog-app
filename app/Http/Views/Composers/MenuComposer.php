<?php

namespace App\Http\View\Composers;

use App\Repositories\UserRepository;
use Illuminate\View\View;

class MenuComposer
{
    /**
     * The user repository implementation.
     *
     * @var \App\Repositories\UserRepository
     */
    protected $users;

    /**
     * Create a new profile composer.
     *
     * @param  \App\Repositories\UserRepository  $users
     * @return void
     */
    public function __construct(RepositoryInterface $res)
    {
        // Dependencies are automatically resolved by the service container...
        $this->menu = $res;
    }

    /**
     * Bind data to the view.
     *
     * @param  \Illuminate\View\View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $listMenu = $this->menu->getMenu(1);
		$listMenuCon = $this->menu->getMenuCon();
		$data = compact('listMenu', 'listMenuCon');
		$view->with($data);
    }
}