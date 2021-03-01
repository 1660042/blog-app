<?php

namespace App\Http\Controllers\Frontend\Category;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\Backend\Category\CategoryRepositoryInterface;
use App\Repositories\Backend\Post\PostRepositoryInterface;

class CategoryController extends Controller
{
    public function __construct(CategoryRepositoryInterface $cat, PostRepositoryInterface $post) {
        $this->cat = $cat;
        $this->post = $post;
        $this->qty = 1;
    }

    public function __invoke(Request $request, $url_page)
    {
        $cat = $this->cat->getCategoryActive('url_page', $url_page);

        if($cat == null) {
            $message = $this->getMessage(false, '', 'Chuyên mục không tồn tại!');
            return redirect()->route('frontend.home')->with($message);
        }

        $posts = $this->post->getDataWithPaginationWithParam($this->qty, 'category_id',$cat->id,'=');

        $data = compact('cat', 'posts');

        if($request->ajax()) {
            return view('frontend.category.pagination_category', $data)->render();
        }

        return view('frontend.category.category', $data);
    }

    private function getPostWithPagination() {

    }
}
