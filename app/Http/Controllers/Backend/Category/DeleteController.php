<?php

namespace App\Http\Controllers\Backend\Category;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\Backend\Category\CategoryRepositoryInterface;

class DeleteController extends Controller
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

        if($cat == false) {
            $this->result = false;
            $this->msg = $this->getMessage($this->result
            , 'Xóa chuyên mục thành công!','Xóa chuyên mục thất bại, vui lòng kiểm tra lại!');
        } else if($cat->parent_id == null && !$this->cat->getChildCategories($id)->isEmpty()) {
            $this->msg = $this->getMessage(false
            , '', 'Chuyên mục này có chứa các chuyên mục con! Vui lòng di chuyển các chuyên mục con qua chuyên mục khác trước!');
        } else {
            $this->result = $this->cat->delete($id);
            $this->msg = $this->getMessage($this->result
            , 'Xóa chuyên mục thành công!','Xóa chuyên mục thất bại, vui lòng kiểm tra lại!');
        }

        return redirect()->route('backend.posts.categories.index')->with($this->msg);
    }
}
