<?php

namespace App\Repositories\Menu;

interface MenuRepositoryInterface
{


    public function getModel();

    public function getMenus($level);

    public function getMenusWithParam($level, $status);
}
