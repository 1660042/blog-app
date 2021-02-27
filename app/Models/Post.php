<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $table = 'post';

    protected $fillable = [    
        'name',
        'category_id',
        'path_image',
        'slug',
        'content',
        'status',
        'created_by',
        'updated_by'
    ];

    public function getCategory() {
        return $this->belongsTo('App\Models\Category', 'category_id', 'id');
    }

    public function createdBy() {
        return $this->belongsTo('App\Models\User', 'created_by', 'id');
    }

    public function updatedBy() {
        return $this->belongsTo('App\Models\User', 'updated_by', 'id');
    }
}
