<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $table = 'category';

    protected $fillable = [
        'name',
        'level',
        'parent_id',
        'number',
        'url_page',
        'status',
        'create_by',
        'update_by'
    ];

    public function category() {
        return $this->belongsTo('App\Models\Category', 'parent_id', 'id');
    }

    public function createBy() {
        return $this->belongsTo('App\Models\User', 'create_by', 'id');
    }

    public function updateBy() {
        return $this->belongsTo('App\Models\User', 'update_by', 'id');
    }
}
