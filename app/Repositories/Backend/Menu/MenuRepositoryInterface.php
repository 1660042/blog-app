<?php 

namespace App\Repositories\Backend\Menu;

interface MenuRepositoryInterface {

    
    public function getModel();

    public function getMenu($level);

    public function getMenuConHD();

    public function getMenuHD();

    public function countMenuConHD($id);

    public function getMenuChaHD($id);

    public function getTablePivot($idQuyen, $idMenu);

    public function getMenuByRouteName($routeName);
}