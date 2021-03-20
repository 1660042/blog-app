<?php

namespace App\Repositories\Menu;

use App\Models\Menu;
use App\Repositories\BaseRepository;
use App\Repositories\Menu\MenuRepositoryInterface;

class MenuRepository extends BaseRepository implements MenuRepositoryInterface
{

    public function getModel()
    {
        return \App\Models\Menu::class;
    }

    public function getMenu($level)
    {
        return $this->_model->whereNull('parent_id')->orderByRaw('number')->get();
    }

    public function getMenuCon()
    {
        return $this->_model->whereNotNull('parent_id')->orderBy('parent_id')->get();
    }
}
