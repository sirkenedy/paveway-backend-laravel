<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Faculty extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'fac_title', 'fac_key',
    ];
    /**
     * Get the departments under this Faculty.
     */

    public function departments()
    {
        return $this->hasMany('App\Department');
    }

    public function programs()
    {
        return $this->hasManyThrough('App\Program','App\Department');
    }
}
