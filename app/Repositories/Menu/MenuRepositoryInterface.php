<?php

namespace App\Repositories\Menu;

interface MenuRepositoryInterface
{


    public function getModel();

    public function getMenu($level);

    public function getMenuCon();
}
