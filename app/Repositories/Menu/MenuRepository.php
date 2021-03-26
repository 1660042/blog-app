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

    public function getMenus($level)
    {
        return $this->_model->whereNull('parent_id')->where([
            ['status', '=', '1'],
        ])->orderByRaw('number')->get();
    }


    public function getMenusWithParam($level, $status, $is_show_role = 1)
    {
        return $this->_model->whereNotNull('parent_id')->where([
            ['level', '=', $level],
            ['status', '=', $status],
            ['is_show_role', '=', $is_show_role],
        ])->orderBy('parent_id')->get();
    }
}
