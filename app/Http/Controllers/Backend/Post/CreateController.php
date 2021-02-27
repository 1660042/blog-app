<?php

namespace App\Http\Controllers\Backend\Post;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\Backend\Category\CategoryRepositoryInterface;

class CreateController extends Controller
{
    public function __construct(CategoryRepositoryInterface $cat) {
        $this->cat = $cat;
    }
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $categories = $this->cat->getAllChildCategoriesActive();
        $data = compact('categories');
        return view('backend.post.create', $data);
    }
}
