<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'website',
        'content',
        'user_id',
        'post_id',
        'answer_comment_id',
    ];

    public function getChildComments()
    {
        return $this->hasMany('App\Models\Comment', 'answer_comment_id', 'id');
    }

    //get avatar from gravatar use email
    public function getAvatarUrl($email)
    {
        return md5($email);
    }
}
