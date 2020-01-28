<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Assignment extends Model
{
    /**
     * Get the lecture/class record associated with the assignment.
     */
    public function lecture()
    {
        return $this->hasOne('App\Lecture');
    }

    
}
