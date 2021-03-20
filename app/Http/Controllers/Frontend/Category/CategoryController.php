<?php

namespace App\Http\Controllers\Frontend\Category;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\Category\CategoryRepositoryInterface;
use App\Repositories\Post\PostRepositoryInterface;

class CategoryController extends Controller
{
    public function __construct(CategoryRepositoryInterface $cat, PostRepositoryInterface $post)
    {
        $this->cat = $cat;
        $this->post = $post;
        $this->qty = 1;
    }

    public function __invoke(Request $request, $url_page)
    {

        $category = $this->cat->getCategoryActive('url_page', $url_page);

        //dd($category);

        $posts = $category->getPosts()->orderBy('id', 'desc')->paginate(1);

        //dd($posts);


        // $comments
        //     ->whereNull('answer_comment_id')
        //     ->orderBy('id', 'desc')
        //     ->paginate(3);

        $data = compact('category', 'posts');

        return view('frontend.category.category', $data);
    }
}
