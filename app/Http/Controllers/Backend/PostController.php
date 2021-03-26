<?php

namespace App\Http\Controllers\Backend;

use Auth;
use App\Models\Tag;
use App\Models\Post;
use Illuminate\Support\Str;
use Illuminate\Support\Arr;
use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Post\PostRequest;
use App\Repositories\Post\PostRepositoryInterface;
use App\Repositories\Category\CategoryRepositoryInterface;


class PostController extends Controller
{

    public function __construct(
        PostRepositoryInterface $post,
        Post $_post,
        CategoryRepositoryInterface $category,
        Tag $tag
    ) {
        $this->post = $post;
        $this->_post = $_post;
        $this->category = $category;
        $this->tag = $tag;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('view', $this->_post);
        $posts = $this->post->getAll();
        $status = config('status.status');
        $data = compact('posts', 'status');

        return view('backend.post.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('create', $this->_post);
        $categoriesPost = "";
        $categories = $this->category->getAllChildCategoriesActive();
        $data = compact('categories', 'categoriesPost');
        return view('backend.post.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostRequest $request)
    {
        $this->authorize('create', $this->_post);
        $fill = $this->getFillable();

        if ($request->has('status') == false) {
            $this->mergeRequest($request, 'status', '0');
        }

        $path_image = Str::of($request->path_image)->replace($this->getUrlUpload(), '');
        $this->mergeRequest($request, 'path_image', $path_image);

        $data = $this->getFilterData($request, $fill);

        $data = Arr::add($data, 'created_by', Auth::id());
        $data = Arr::add($data, 'updated_by', Auth::id());

        //dd($data);

        //dd(array_map('trim', Str::of($request->tag)->split('/[,]+/')->toArray()));

        $result = $this->post->create($data);

        //dd($result->id);



        $post = $this->post->find($result->id);

        //dd(Str::of($request->tag)->split('/[,]+/'));

        $post->getCategories()->detach();

        $post->getCategories()->attach($request->category_id);

        if ($request->has('tag')) {
            $listTags = array_map('trim', Str::of($request->tag)->split('/[,]+/')->toArray());
            $this->insertTag($listTags);

            $listTagsId = $this->tag->whereIn('name', $listTags)->get();

            $post->getTags()->detach();
            $post->getTags()->attach($listTagsId);
        }

        $message = $this->getMessage(
            $result,
            'Thêm thành công bài viết!',
            'Thêm thất bại, vui lòng kiểm tra lại!'
        );


        return redirect()->route('backend.posts.posts.index')->with($message);
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

        $this->authorize('update', $this->_post);
        $post = $this->post->find($id);

        if ($post == false) {
            $message = $this->getMessage(false, '', 'Bài viết không tồn tại!');
            return redirect()->route('backend.posts.posts.index')->with($message);
        } else {
            $post->path_image = $this->getUrlUpload() . $post->path_image;

            //dd($post->getCategories->toArray());

            $categoriesPost = "";

            foreach ($post->getCategories->toArray() as  $key) {
                $categoriesPost = $categoriesPost . ", " . $key['id'];
            }

            foreach ($post->getCategories->toArray() as  $key) {
                $categoriesPost = $categoriesPost . ", " . $key['id'];
            }

            $tag = $post->getTags->implode('name', ', ');

            $categories = $this->category->getAllChildCategoriesActive();
            $data = compact('categories', 'post', 'categoriesPost', 'tag');
            return view('backend.post.edit', $data);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PostRequest $request, $id)
    {

        $this->authorize('update', $this->_post);
        $post = $this->post->find($id);
        //dd(array_values($request->category_id));


        if ($post == false) {

            $result = false;
        } else {

            $fill = $this->getFillable();

            if ($request->has('status') == false) {
                $this->mergeRequest($request, 'status', '0');
            }

            $path_image = Str::of($request->path_image)->replace($this->getUrlUpload(), '');
            $this->mergeRequest($request, 'path_image', $path_image);

            $data = $this->getFilterData($request, $fill);

            $data = Arr::add($data, 'update_by', Auth::id());

            $result = $this->post->update($id, $data);

            $post->getCategories()->detach();

            $post->getCategories()->attach($request->category_id);

            if ($request->has('tag')) {
                $listTags = array_map('trim', Str::of($request->tag)->split('/[,]+/')->toArray());
                $this->insertTag($listTags);

                $listTagsId = $this->tag->whereIn('name', $listTags)->get();

                $post->getTags()->detach();
                $post->getTags()->attach($listTagsId);
            }
        }

        $message = $this->getMessage(
            $result,
            'Sửa thành công bài viết!',
            'Sửa thất bại, vui lòng kiểm tra lại!'
        );


        return redirect()->route('backend.posts.posts.index')->with($message);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->authorize('update', $this->_post);
        $post = $this->post->find($id);

        if ($post == false) {
            $result = false;
        } else {
            $result = $this->post->delete($id);

            $post->getCategories()->detach();
            $post->getTags()->detach();
        }

        $message = $this->getMessage(
            $result,
            'Xóa bài viết thành công!',
            'Xóa bài viết thất bại, vui lòng kiểm tra lại!'
        );

        return redirect()->route('backend.posts.posts.index')->with($message);
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
