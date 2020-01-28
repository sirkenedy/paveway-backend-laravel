<?php

namespace App\Traits;

use illuminate\Http\Request;

trait StoreBookFileTrait {

    public function uploadBookFile(Request $request, $fieldname)
    {
        $file = $request->file($fieldname);
        $filename = $file->getClientOriginalName();
        $extension = $file->getClientOriginalExtension();
        $material = pathinfo($filename, PATHINFO_FILENAME)."-".time();

        if(\Cloudder::upload($file, "paveway/books/".$material))
        {
            $c=\Cloudder::getResult();

              return $c;
        }
        return null;
    }

    public function removeFile($publicId)
    {

        if(\Cloudder::destroyImage($publicId))
        {

              return true;
        }
        return false;
    }

    public function updateFile($request, $fieldname, $publicId)
    {
        $file = $request->file($fieldname);
        $filename = $file->getClientOriginalName();
        $extension = $file->getClientOriginalExtension();
        $material = pathinfo($filename, PATHINFO_FILENAME)."-".time();

        if(\Cloudder::upload($file, $publicId))
        {
            $c=\Cloudder::getResult();
            return $c;
        }
        // return false;
    }
}