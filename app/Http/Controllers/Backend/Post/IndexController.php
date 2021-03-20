<?php

namespace App\Http\Controllers\Backend\Post;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Post\PostRepositoryInterface;

class IndexController extends Controller
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
    public function __invoke(Request $request)
    {
        $posts = $this->post->getAll();
        $status = config('status.status');
        $data = compact('posts', 'status');

        return view('backend.post.index', $data);
    }
}
