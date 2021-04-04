<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\Post\PostRepositoryInterface;

class SearchController extends Controller
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
        $keyword = $request->keyword;
        $pathImage = $this->getUrlUpload();
        $posts = $this->post->searchPost('name', '%' . $keyword . '%', 'like')->orderBy('id', 'desc')->paginate($this->qty);
        return view('frontend.search', compact('posts', 'pathImage'));
    }
}
