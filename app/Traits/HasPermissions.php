<?php

namespace App\Traits;

use Auth;
use App\Models\Menu;

trait HasPermissions
{
    public function hasPermissions($nameRoute, $permission)
    {
        $menu = new Menu();
        $menu = $menu->where([
            ['name_route', '=', $nameRoute],
            ['status', '=', '1']
        ])->first();
        $roles = Auth::user()->getRoles->where('status', '=', '1');
        $result = false;
        foreach ($roles as $role) {
            if ($role->getPermissions->where('menu_id', '=', $menu->id)
            ->where($permission, '=', 1)
            ->first() != null) {
                $result = $role->getPermissions
                ->where('menu_id', '=', $menu->id)
                ->where($permission, '=', '1')->first();
                if ($result->access == '1' && $result->$permission == '1')
                    return $result;
            }
        }
        return false;
    }
}
