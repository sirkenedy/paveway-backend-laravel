<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    /**
     * Get the programs that belong to this course.
    */
    public function programs()
    {
        return $this->belongsToMany('App\Program');
    }

    
}
