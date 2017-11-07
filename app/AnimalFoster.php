<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AnimalFoster extends Model
{
    public function foster()
    {
        return $this->belongsTo('App\User', 'foster_id', 'id');
    }
}
