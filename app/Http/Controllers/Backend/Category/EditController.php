<?php

namespace App\Http\Controllers\Backend\Category;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Backend\Category\CategoryRepositoryInterface;

class EditController extends Controller
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
    public function __invoke(Request $request, $id)
    {
        $cat = $this->cat->find($id);
        $categories = $this->cat->getCategoryMainWithParam($id);
        $data = compact('categories', 'cat');
        return view('backend.category.edit', $data);
    }
}
