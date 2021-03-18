<?php

namespace App\Http\Controllers\Backend\Post;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\Backend\Category\CategoryRepositoryInterface;
use App\Repositories\Backend\Post\PostRepositoryInterface;

class EditController extends Controller
{
    public function __construct(CategoryRepositoryInterface $cat, PostRepositoryInterface $post)
    {
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

        if ($post == false) {

            $this->result = false;
            $this->msg = $this->getMessage($this->result, '', 'Bài viết không tồn tại!');
            return redirect()->route('backend.posts.posts.index')->with($this->msg);
        } else {
            $post->path_image = $this->getUrlUpload() . $post->path_image;

            //dd($post->getCategories->toArray());

            $categoriesPost = "";

            foreach ($post->getCategories->toArray() as  $key) {
                $categoriesPost = $categoriesPost . ", " . $key['id'];
            }

            foreach ($post->getCategories->toArray() as  $key) {
                $categoriesPost = $categoriesPost . ", " . $key['id'];
            }

            $tag = $post->getTags->implode('name', ', ');

            $categories = $this->cat->getAllChildCategoriesActive();
            $data = compact('categories', 'post', 'categoriesPost', 'tag');
            return view('backend.post.edit', $data);
        }
    }
}
