<?php

namespace App\Repositories\Post;

use App\Models\Post;
use App\Repositories\BaseRepository;
use App\Repositories\Post\PostRepositoryInterface;

class PostRepository extends BaseRepository implements PostRepositoryInterface
{

    public function getModel()
    {
        return \App\Models\Post::class;
    }

    public function getPost($key, $value, $compare)
    {
        return $this->_model->where([
            [$key, $compare, $value],
            ['status', '=', '1']
        ])->first();
    }
}
