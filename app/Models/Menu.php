<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Menu extends Model
{
    use HasFactory;

    public function getChildMenus()
    {
        return $this->hasMany(Menu::class, 'parent_id', 'id');
    }

    public function getParentMenu()
    {
        return $this->belongsTo(Menu::class, 'parent_id', 'id');
    }

    public function getRoles()
    {
        return $this->belongsToMany(Role::class, 'permissions', 'menu_id', 'role_id')
            ->withPivot('menu_id', 'indexAll', 'index', 'show', 'create', 'edit', 'delete', 'censor');
    }
}
