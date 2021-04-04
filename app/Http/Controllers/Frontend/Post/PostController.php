<?php

namespace App\Http\Controllers\Frontend\Post;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\Post\PostRepositoryInterface;

class PostController extends Controller
{
    public function __construct(PostRepositoryInterface $post)
    {
        $this->post = $post;
    }
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request, $slug)
    {
        $post = $this->post->getPost('slug', $slug, '=');
        //dd($post->id);
        if ($post == null) {
            $message = $this->getMessage(false, '', 'Bài viết không tồn tại!');
            return redirect()->route('frontend.home')->with($message);
        }

        // $a = $post->getComments()->whereNull('answer_comment_id')->orderBy('id', 'desc')->paginate($this->qty);
        // foreach ($a as $key) {
        //     // foreach ($key->getChildComments as $child) {
        //     //     dd($child);
        //     // }
        //     dd($key->getChildComments);
        // }

        $prePost = $this->post->getPost('id', $post->id, '<', 'id', 'desc');

        $nextPost = $this->post->getPost('id', $post->id, '>', 'id', 'asc');

        //dd($prePost);
        $qty = $this->qty;
        if ($request->ajax()) {

            $comments = $post->getComments();

            return view('components.comment', compact('comments', 'qty'))->render();
        }

        $pathImage = $this->getUrlUpload();


        $data = compact('post', 'prePost', 'nextPost', 'pathImage', 'qty');

        return view('frontend.post.single_post', $data);
    }
}
