<?php

namespace App\Http\Controllers\Backend\Post;

use Auth;
use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Post\PostRepositoryInterface;

class IndexController extends Controller
{

    public function __construct(PostRepositoryInterface $post)
    {
        $this->post = $post;
        
        $this->middleware('can:view, post');
    }

    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request, Post $post)
    {
        //$this->authorize('viewAny', $post);
        $posts = $this->post->getAll();
        $status = config('status.status');
        $data = compact('posts', 'status');

        return view('backend.post.index', $data);
    }
}
