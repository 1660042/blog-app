<?php

namespace App\Http\Controllers\Backend\Post;

use Auth;
use App\Models\Tag;
use Illuminate\Support\Str;
use Illuminate\Support\Arr;
use App\Http\Controllers\Controller;
use App\Repositories\Backend\Post\PostRepositoryInterface;
use App\Http\Requests\Backend\Post\CreateRequest;

class StoreController extends Controller
{

    public function __construct(PostRepositoryInterface $post, Tag $tag)
    {
        $this->post = $post;
        $this->tag = $tag;
    }

    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(CreateRequest $request)
    {

        $fill = $this->getFillable();

        if ($request->has('status') == false) {
            $this->mergeRequest($request, 'status', '0');
        }

        $path_image = Str::of($request->path_image)->replace($this->getUrlUpload(), '');
        $this->mergeRequest($request, 'path_image', $path_image);

        $data = $this->getFilterData($request, $fill);

        $data = Arr::add($data, 'create_by', Auth::id());

        //dd($data);

        //dd(array_map('trim', Str::of($request->tag)->split('/[,]+/')->toArray()));

        $this->result = $this->post->create($data);

        //dd($this->result->id);



        $post = $this->post->find($this->result->id);

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

        $this->msg = $this->getMessage(
            $this->result,
            'Thêm thành công bài viết!',
            'Thêm thất bại, vui lòng kiểm tra lại!'
        );


        return redirect()->route('backend.posts.posts.index')->with($this->msg);
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
