<?php

namespace App\Http\Views\Composers;

use App\Repositories\Menu\MenuRepositoryInterface;
use App\Repositories\Menu\MenuRepository;

use Illuminate\View\View;

class MenuComposer
{

    protected $menu;

    public function __construct()
    {
        // Dependencies are automatically resolved by the service container...
        $this->menu = new MenuRepository();
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
        //dd($listMenu);
        $listMenuCon = $this->menu->getMenuCon();
        $data = compact('listMenu', 'listMenuCon');
        $view->with($data);
    }
}
