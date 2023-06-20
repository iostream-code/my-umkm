<?php

namespace App\Traits;

use Illuminate\Support\Facades\Storage;

trait UploadImage
{
    public function storeImage($request)
    {
        $file = $request->file('picture');
        $path = time() . '_' . $request->name . '.' . $file->getClientOriginalExtension();

        Storage::disk('local')->put('public/' . $path, file_get_contents($file));

        return $path;
    }
}
