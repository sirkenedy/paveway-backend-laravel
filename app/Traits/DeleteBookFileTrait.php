<?php

namespace App\Traits;

use illuminate\Http\Request;

trait DeleteBookFileTrait {

    public function removeBookFile($publicId)
    {

        if(\Cloudder::destroyImage($publicId))
        {

              return true;
        }
        return null;
    }
}