<?php

namespace App\Http\Controllers\Frontend\Tag;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\Tag\TagRepositoryInterface;
use App\Repositories\Post\PostRepositoryInterface;

class TagController extends Controller
{
    public function __construct(TagRepositoryInterface $cat, PostRepositoryInterface $post)
    {
        $this->cat = $cat;
        $this->post = $post;
        $this->qty = 1;
    }

    public function __invoke(Request $request, $name)
    {

        $tag = $this->cat->getTagActive('name', $name);

        //d($tag);

        $posts = $tag->getPosts()->orderBy('id', 'desc')->paginate($this->qty);

        //dd($posts);

        //dd($posts);


        // $comments
        //     ->whereNull('answer_comment_id')
        //     ->orderBy('id', 'desc')
        //     ->paginate(3);

        $data = compact('tag', 'posts');

        return view('frontend.tag.tag', $data);
    }
}
