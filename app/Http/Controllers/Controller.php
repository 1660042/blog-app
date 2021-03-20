<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function getUrlUpload()
    {
        return config('filesystems.disks.public.url') . '/' . config('lfm.folder_categories.image.folder_name');
    }

    public function getMessage($result, $success, $error)
    {
        if ($result) {
            $message = [
                'message' => __($success),
                'type' => 'success'
            ];
        } else {
            $message = [
                'message' => __($error),
                'type' => 'error'
            ];
        }
        return $message;
    }
}
