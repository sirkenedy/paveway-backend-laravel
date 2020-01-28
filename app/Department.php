<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'dep_title', 'dep_key', 'faculty_id',
    ];
    
    /**
     * Get the programs under this department.
     */

    public function programs()
    {
        return $this->hasMany('App\Program');
    }

    /**
     * Get the faculty that this department belong.
     */
    
    public function faculty()
    {
        return $this->belongsTo('App\Faculty');
    }
}
