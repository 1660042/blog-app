<?php

namespace App\Models;

use App\Traits\HasPermissions;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory, HasPermissions;

    protected $fillable = [
        'name',
        'level',
        'parent_id',
        'number',
        'name_route',
        'status',
        'created_by',
        'updated_by'
    ];

    public function category()
    {
        return $this->belongsTo('App\Models\Category', 'parent_id', 'id');
    }

    public function createdBy()
    {
        return $this->belongsTo('App\Models\User', 'created_by', 'id');
    }

    public function updatedBy()
    {
        return $this->belongsTo('App\Models\User', 'updated_by', 'id');
    }

    public function getChildCategories()
    {
        return $this->hasMany(Category::class, 'parent_id', 'id');
    }

    public function getPosts()
    {
        return $this->belongsToMany(Post::class, 'post_category', 'category_id', 'post_id');
    }
}
