<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'path_image',
        'slug',
        'content',
        'status',
        'created_by',
        'updated_by'
    ];

    public function getCategory()
    {
        return $this->belongsTo('App\Models\Category', 'category_id', 'id');
    }

    public function createdBy()
    {
        return $this->belongsTo('App\Models\User', 'created_by', 'id');
    }

    public function updatedBy()
    {
        return $this->belongsTo('App\Models\User', 'updated_by', 'id');
    }

    public function getCategories()
    {
        return $this->belongsToMany(Category::class, 'post_category', 'post_id', 'category_id');
    }

    public function getTags()
    {
        return $this->belongsToMany(Tag::class, 'post_tag', 'post_id', 'tag_id');
    }

    public function getComments()
    {
        return $this->hasMany(Comment::class, 'post_id', 'id');
    }
}
