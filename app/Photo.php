<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    public function media()
    {
        return $this->hasMany('App\Media');
    }
}
