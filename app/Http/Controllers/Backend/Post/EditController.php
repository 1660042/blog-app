<?php

namespace App\Http\Controllers\Backend\Post;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\Backend\Category\CategoryRepositoryInterface;
use App\Repositories\Backend\Post\PostRepositoryInterface;

class EditController extends Controller
{
    public function __construct(CategoryRepositoryInterface $cat, PostRepositoryInterface $post) {
        $this->cat = $cat;
        $this->post = $post;
    }
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request, $id)
    {
        $post = $this->post->find($id);
        $post->path_image = $this->getUrlUpload() . $post->path_image;
        $categories = $this->cat->getAllChildCategoriesActive();
        $data = compact('categories', 'post');
        return view('backend.post.edit', $data);
    }
}
