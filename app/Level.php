<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Level extends Model
{
    protected $fillable = [
        'year'
    ];
    /**
     * Get the users/students that belonds to this level.
     */
    public function users()
    {
        return $this->hasMany('App\User');
    }
}
