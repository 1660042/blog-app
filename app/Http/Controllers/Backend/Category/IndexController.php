<?php

namespace App\Http\Controllers\Backend\Category;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Backend\Category\CategoryRepositoryInterface;

class IndexController extends Controller
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
        $categories = $this->cat->getAll();
        $status = config('status.status');
        $data = compact('categories', 'status');

        return view('backend.category.index', $data);
    }
}
