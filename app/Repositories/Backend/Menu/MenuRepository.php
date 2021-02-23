<?php
namespace App\Repositories\Backend\Menu;

use App\Models\Menu;
use App\Repositories\BaseRepository;
use App\Repositories\Backend\Menu\MenuRepositoryInterface;

class MenuRepository extends BaseRepository implements MenuRepositoryInterface {
    
    public function getModel() {
        return \App\Models\Menu::class;
    }

    public function getMenu($level) {
        return $this->_model->whereNull('parent_id')->orderByRaw('number')->get();
    }

    public function getMenuCon() {
        return $this->_model->whereNotNull('parent_id')->orderBy('parent_id')->get();
    }
}