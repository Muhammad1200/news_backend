<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Storage;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function upload($file ,$path,$request)
    {

        if ($request->hasFile($file)) {
            $original_pic = $request->file($file);

            $file_extension = $original_pic->getClientOriginalExtension();
            $filename = time() . '.' . $file_extension;

            # upload original image
            Storage::put($path.'/' . $filename, (string) file_get_contents($original_pic), 'public');

            return $path.'/'.$filename;
        }
    }

    public function uploadUsingUrl($path,$url)
    {
        $contents = file_get_contents($url);
        $name = substr($url, strrpos($url, '/') + 1);
        Storage::put($path.$name, $contents,'public');
    }
}
