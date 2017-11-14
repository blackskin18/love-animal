<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserRole extends Model
{

  	public function role()
    {
         return $this->belongsTo('App\RoleInfo');
    }

}
