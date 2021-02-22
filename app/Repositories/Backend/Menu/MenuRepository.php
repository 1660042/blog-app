<?php
namespace App\Repositories\Backend\Menu;

use App\Repositories\RepositoryInterface;

abstract class MenuRepository extends BaseRepository implements MenuRepositoryInterface {
    
    public function getModel() {
        return \App\Menu::class;
    }

    public function getMenu($level) {
        return $this->_model->where([
            ['parent_id', '=', $level]
            //,
            // ['status', '=', 1],
            // ['view', '=', 1]
        ])->orderByRaw('number')->get();
    }

    public function getMenuCon() {
        return $this->_model->whereNotNull('parent_id')->orderBy('parent_id')->get();
    }
}