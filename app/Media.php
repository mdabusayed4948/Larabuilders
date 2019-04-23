<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    protected $fillable = [
        'image','photo_id',
    ];

    public function photo()
    {
        return $this->belongsTo('App\Photo');
    }
}
