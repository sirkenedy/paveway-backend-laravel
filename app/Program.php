<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Program extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title', 'key', 'department_id',
    ];
    /**
     * Get the students that belong to a particular program.
    */
    
    public function users()
    {
        return $this->hasMany('App\User');
    }

    /**
     * Get the Department that this program belong.
     */
    
    public function department()
    {
        return $this->belongsTo('App\Department');
    }

    /**
     * Get the courses that belong to this program.
    */
    public function courses()
    {
        return $this->belongsToMany('App\Course');
    }

    public function books()
    {
        return $this->hasMany('App\Book');
    }

    // protected function formatInputKey($request)
    // {
    //     return [
    //         'dep_title' => $request->title,
    //         'dep_key' => $request->key,
    //         'faculty_id'=> $request->facultyId
    //     ];
    //  }
}
