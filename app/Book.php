<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title', 'author', 'publisher', 'material', 'posted_by','publicId',
    ];

    public function program()
    {
        return $this->belongsTo('App\Program');
    }
}
