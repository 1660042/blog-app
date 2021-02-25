<?php

namespace App\Http\Controllers\Backend\Ajax;

use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AjaxController extends Controller
{
    public function getSlug(Request $request) {
        if($request->ajax()) {
            
            $slug = Str::slug($request->name);
            return $slug;
        }
        
    }
}
