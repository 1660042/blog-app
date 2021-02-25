<?php

namespace App\Http\Controllers\Backend\Ajax;

use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AjaxController extends Controller
{
    public function getSlug(Request $request) {
        if($request->ajax()) {
            //$slug = Str::slug('Laravel 5 Framework', '-');
            
        }
        $slug = 'Laravel 5 Framework';
        return 'Laravel 5 Framework';
    }
}
