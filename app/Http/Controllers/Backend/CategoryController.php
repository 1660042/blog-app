<?php

namespace App\Http\Controllers\Backend;

use Auth;
use App\Models\Tag;
use App\Models\Category;
use Illuminate\Support\Arr;
use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Category\CategoryRequest;
use App\Repositories\Category\CategoryRepositoryInterface;


class CategoryController extends Controller
{

    public function __construct(
        Category $_category,
        CategoryRepositoryInterface $category,
        Tag $tag
    ) {
        $this->_category = $_category;
        $this->category = $category;
        $this->tag = $tag;
        $this->authorizeResource(Category::class);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$this->authorize('view', $this->_category);
        $categories = $this->category->getAll();
        $status = config('status.status');
        $data = compact('categories', 'status');

        return view('backend.category.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('create', $this->_category);
        $categories = $this->category->getCategoryMain();
        $data = compact('categories');
        return view('backend.category.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryRequest $request)
    {
        //$this->authorize('store', $this->_category);
        $fill = $this->getFillable();

        if ($request->has('status') == false) {
            $this->mergeRequest($request, 'status', '0');
        }

        $data = $this->getFilterData($request, $fill);

        if ($request->parent_id == null) {
            $data = Arr::add($data, 'parent_id', $request->parent_id);
            $data = Arr::add($data, 'level', 1);
        } else {
            $data = Arr::add($data, 'level', 2);
        }
        $data = Arr::add($data, 'number', $this->category->max('number') + 1);
        $data = Arr::add($data, 'create_by', Auth::id());


        $result = $this->category->create($data);

        $message = $this->getMessage(
            $result,
            'Thêm thành công chuyên mục!',
            'Thêm thất bại, vui lòng kiểm tra lại!'
        );


        return redirect()->route('backend.posts.categories.index')->with($message);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //$this->authorize('update', $this->_category);
        $cat = $this->category->find($id);
        $categories = $this->category->getCategoryMainWithParam($id);
        $data = compact('categories', 'cat');
        return view('backend.category.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CategoryRequest $request, $id)
    {

        $cat = $this->category->find($id);

        if ($cat == false) {

            $result = false;
        } else {

            $fill = $this->getFillable();

            if ($request->has('status') == false) {
                $this->mergeRequest($request, 'status', '0');
            }

            $data = $this->getFilterData($request, $fill);

            if ($request->parent_id == null) {
                $data = Arr::add($data, 'parent_id', $request->parent_id);
                $data = Arr::add($data, 'level', 1);
            } else {
                $data = Arr::add($data, 'level', 2);
            }
            //$data = Arr::add($data, 'number', $this->category->max('number') + 1);
            $data = Arr::add($data, 'update_by', Auth::id());

            //dd($data);
            $result = $this->category->update($id, $data);
        }

        $message = $this->getMessage($result, 'Sửa thành công chuyên mục!', 'Sửa thất bại, vui lòng kiểm tra lại!');


        return redirect()->route('backend.posts.categories.index')->with($message);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //$this->authorize('delete', $this->_category);
        $cat = $this->category->find($id);

        if ($cat == false) {
            $result = false;
            $message = $this->getMessage(
                $result,
                'Xóa chuyên mục thành công!',
                'Xóa chuyên mục thất bại, vui lòng kiểm tra lại!'
            );
        } else if ($cat->parent_id == null && !$this->category->getChildCategories($id)->isEmpty()) {
            $message = $this->getMessage(
                false,
                '',
                'Chuyên mục này có chứa các chuyên mục con! Vui lòng di chuyển các chuyên mục con qua chuyên mục khác trước!'
            );
        } else {
            $result = $this->category->delete($id);
            $message = $this->getMessage(
                $result,
                'Xóa chuyên mục thành công!',
                'Xóa chuyên mục thất bại, vui lòng kiểm tra lại!'
            );
        }

        return redirect()->route('backend.posts.categories.index')->with($message);
    }

    private function getFillable()
    {
        return config('fillable.post');
    }

    private function getFilterData($request, $fillable)
    {
        return array_filter($request->only($fillable), 'strlen');
    }

    //Thêm 1 field vào request
    private function mergeRequest($request, $nameRequest, $value)
    {
        return $request->merge([$nameRequest => $value]);
    }

    private function insertTag($listTags)
    {

        $data = array_filter($listTags, function ($tag) {
            if ($this->tag->where('name', '=', $tag)->count() == 0) {
                return ['name' => $tag];
            }
        });
        if (sizeof($data) > 0) {
            $data = array_map(function ($tag) {
                if ($this->tag->where('name', '=', $tag)->count() == 0) {
                    return ['name' => $tag];
                }
            }, $data);
        }

        $this->tag->insert($data);
    }
}
