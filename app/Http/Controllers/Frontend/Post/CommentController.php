<?php

namespace App\Http\Controllers\Frontend\Post;

use Auth;
use App\Http\Controllers\Controller;
use App\Http\Requests\Frontend\Comment\CommentRequest;
use App\Repositories\Comment\CommentRepositoryInterface;
use App\Repositories\Post\PostRepositoryInterface;

class CommentController extends Controller
{
    public function __construct(CommentRepositoryInterface $comment, PostRepositoryInterface $post)
    {
        $this->comment = $comment;
        $this->post = $post;
    }
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(CommentRequest $request, $id)
    {
        if ($request->ajax()) {

            $post = $this->post->find($id);

            $comments = $post->getComments();

            if (Auth::id()) {
                $this->mergeRequest($request, 'user_id', Auth::id());
            }

            $result = $this->comment->create($request->all());

            $message = $this->getMessage(true, 'Thêm bình luận thành công!', 'Đã có lỗi xảy ra! Vui lòng xem lại!');

            $qty = $this->qty;
            return view('components.comment', compact('comments', 'qty'))->render();
            //return $result;
        } else {
            return 'not ajax';
        }
    }

    //Thêm 1 field vào request
    private function mergeRequest($request, $nameRequest, $value)
    {
        return $request->merge([$nameRequest => $value]);
    }
}
