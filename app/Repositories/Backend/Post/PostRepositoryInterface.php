<?php 

namespace App\Repositories\Backend\Post;

interface PostRepositoryInterface {

    
    public function getModel();
    public function getPost($key, $value, $compare);
    public function getPreNextPost($key, $value, $compare, $orderBy, $orderBy2);
    //public function getPost($level);

    
}