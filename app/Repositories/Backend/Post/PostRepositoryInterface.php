<?php 

namespace App\Repositories\Backend\Post;

interface PostRepositoryInterface {

    
    public function getModel();
    public function getPost($key, $value);

    //public function getPost($level);

    
}