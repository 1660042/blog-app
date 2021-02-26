<?php
namespace App\Repositories\Backend\Post;

use App\Models\Post;
use App\Repositories\BaseRepository;
use App\Repositories\Backend\Post\PostRepositoryInterface;

class PostRepository extends BaseRepository implements PostRepositoryInterface {
    
    public function getModel() {
        return \App\Models\Post::class;
    }

    // public function getPost($level) {
    //     return $this->_model->whereNull('parent_id')->orderByRaw('number')->get();
    // }

}