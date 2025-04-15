<?php

use Illuminate\Http\UploadedFile;

if (! function_exists('uploadFile')) {
    /**
     * Handle file upload.
     *
     * @param UploadedFile $file
     * @param string $path
     * @return string
     */
    function uploadFile(UploadedFile $file, string $path): string
    {
        $fileName = uniqid() . '.' . $file->getClientOriginalExtension();
        $publicPath = public_path($path);
        $file->move($publicPath, $fileName);
        return $fileName;
    }
}
