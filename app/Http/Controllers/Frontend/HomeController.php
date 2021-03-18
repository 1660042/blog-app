<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\Backend\Post\PostRepositoryInterface;

class HomeController extends Controller
{
    public function __construct(PostRepositoryInterface $post)
    {
        $this->post = $post;
    }
    public function __invoke(Request $request)
    {
        //Số lượng bài viết mỗi trang
        $qty = 4;

        $posts = $this->post->getDataWithPagination($qty);

        $pathImage = $this->getUrlUpload();


        $data = compact('posts', 'pathImage');

        if ($request->ajax()) {
            return view('frontend.pagination_home', $data)->render();
        }

        return view('frontend.home', $data);
    }
}
