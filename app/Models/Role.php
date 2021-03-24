<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'name',
        'description',
        'status',
        'created_by',
        'updated_by',
    ];

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by', 'id');
    }

    public function updatedBy()
    {
        return $this->belongsTo(User::class, 'updated_by', 'id');
    }

    public function getPermissions()
    {
        return $this->hasMany(Permission::class, 'role_id', 'id');
    }

    public function getMenus()
    {
        return $this->belongsToMany(Menu::class, 'permissions', 'role_id', 'menu_id')
            ->withPivot('menu_id', 'indexAll', 'index', 'show', 'create', 'edit', 'delete', 'censor');
    }
}
