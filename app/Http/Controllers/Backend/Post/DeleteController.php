<?php

namespace App\Http\Controllers\Backend\Post;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\Backend\Post\PostRepositoryInterface;

class DeleteController extends Controller
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
    public function __invoke(Request $request, $id)
    {
        $post = $this->post->find($id);

        if ($post == false) {
            $this->result = false;
        } else {
            $this->result = $this->post->delete($id);

            $post->getCategories()->detach();
            $post->getTags()->detach();
        }

        $this->msg = $this->getMessage(
            $this->result,
            'Xóa bài viết thành công!',
            'Xóa bài viết thất bại, vui lòng kiểm tra lại!'
        );

        return redirect()->route('backend.posts.posts.index')->with($this->msg);
    }
}
