<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lecture extends Model
{
    /**
     * Get the list of student attendace for this lecture.
     */
    public function attendances()
    {
        return $this->hasMany('App\Attendance');
    }

    /**
     * Get the assignment record associated with the lecture.
     */
    public function assignment()
    {
        return $this->hasOne('App\Assignment');
    }

    /**
     * Get the lecturer/user record associated with the class 
     *                      or 
     * the lecturer that created this class.
     */
    public function user()
    {
        return $this->hasOne('App\User');
    }

    /**
     * Get the lecture/class record associated with the assignment.
     */
    public function course()
    {
        return $this->hasOne('App\Course');
    }


}
