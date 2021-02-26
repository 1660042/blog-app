<?php

namespace App\Http\Controllers\Backend\Category;

use Auth;
use Illuminate\Support\Arr;
use App\Http\Controllers\Controller;
use App\Repositories\Backend\Category\CategoryRepositoryInterface;
use App\Http\Requests\Backend\Category\CreateRequest;

class StoreController extends Controller
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
    public function __invoke(CreateRequest $request) {
        
        $fill = $this->getFillable();

        if($request->has('status') == false) {
            $this->mergeRequest($request, 'status', '0');
        }

        $data = $this->getFilterData($request, $fill);

        if($request->parent_id == null) {
            $data = Arr::add($data, 'parent_id', $request->parent_id);
            $data = Arr::add($data, 'level', 1);
        } else {
            $data = Arr::add($data, 'level', 2);
        }
        $data = Arr::add($data, 'number', $this->cat->max('number') + 1);
        $data = Arr::add($data, 'create_by', Auth::id());


        $this->result = $this->cat->create($data);

        $this->msg = $this->getMessage($this->result, 'Thêm thành công chuyên mục!'
        , 'Thêm thất bại, vui lòng kiểm tra lại!');


        return redirect()->route('backend.posts.categories.index')->with($this->msg);
    }

    private function getFillable() {
        return config('fillable.category');
    }

    private function getFilterData($request, $fillable) {
        return array_filter($request->only($fillable), 'strlen');
        //return array_filter($request->only($fillable));
    }

    //Thêm 1 field vào request
    private function mergeRequest($request, $nameRequest, $value) {
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
