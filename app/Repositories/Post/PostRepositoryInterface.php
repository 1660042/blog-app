<?php

namespace App\Repositories\Post;

interface PostRepositoryInterface
{


    public function getModel();
    public function getPost($key, $value, $compare);
    //public function getPost($level);


}
