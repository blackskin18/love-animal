<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\AnimalImage;

class Animal extends Model
{
    public $table="animals";
    protected $fillable=['id','name','input_date','age','description','address','status','note','type','change_status_date', 'statuses.name'];
    
    public function animalImage()
    {
    	return $this->hasMany('App\AnimalImage');
    }

    public function status()
    {
    	return $this->hasOne('App\Status');
    }
}
