<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    /**
     * Get the class/lecture to which this student attendance belongs.
     */
    public function lecture()
    {
        return $this->belongsTo('App\Lecture');
    }
}
