<?php

namespace App\Http\Controllers\Backend\Category;

use Auth;
use Illuminate\Support\Arr;
use App\Http\Controllers\Controller;
use App\Repositories\Category\CategoryRepositoryInterface;
use App\Http\Requests\Backend\Category\EditRequest;

class UpdateController extends Controller
{
    public function __construct(CategoryRepositoryInterface $cat)
    {
        $this->cat = $cat;
    }

    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(EditRequest $request, $id)
    {

        $cat = $this->cat->find($id);

        if ($cat == false) {

            $this->result = false;
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
            //$data = Arr::add($data, 'number', $this->cat->max('number') + 1);
            $data = Arr::add($data, 'update_by', Auth::id());

            //dd($data);
            $this->result = $this->cat->update($id, $data);
        }

        $this->msg = $this->getMessage($this->result, 'Sửa thành công chuyên mục!', 'Sửa thất bại, vui lòng kiểm tra lại!');


        return redirect()->route('backend.posts.categories.index')->with($this->msg);
    }

    private function getFillable()
    {
        return config('fillable.category');
    }

    private function getFilterData($request, $fillable)
    {
        return array_filter($request->only($fillable), 'strlen');
        //return array_filter($request->only($fillable));
    }

    //Thêm 1 field vào request
    private function mergeRequest($request, $nameRequest, $value)
    {
        return $request->merge([$nameRequest => $value]);
    }

    // private function getMessage($result, $success, $error) {
    //     if($result) {
    //         $message = [
    //             'message' => __($success), 
    //             'type' => 'success'
    //         ];
    //     } else {
    //         $message = [
    //             'message' => __($error), 
    //             'type' => 'danger'
    //         ];
    //     }
    //     return $message;
    // }
}
