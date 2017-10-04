<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Animal extends Model
{
    public $table="animals";
    protected $fillable=['id','name','input_date','age','description','address','status','note','type','change_status_date'];
    public function animalImage(){
    	return $this->hasMany('App\AnimalImage');
    }
}
