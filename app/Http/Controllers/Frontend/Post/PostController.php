<?php

namespace App\Http\Controllers\Frontend\Post;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\Backend\Post\PostRepositoryInterface;

class PostController extends Controller
{
    public function __construct(PostRepositoryInterface $post) {
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
        $post = $this->post->getPost('slug', $slug);

        if($post == null) {
            $message = $this->getMessage(false, '', 'Bài viết không tồn tại!');
            return redirect()->route('frontend.home')->with($message);
        }
        $data = compact('post');

        return view('frontend.post.single_post', $data);
    }
}
