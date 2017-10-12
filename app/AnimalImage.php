<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AnimalImage extends Model
{
    public $table="animal_images";
    protected $fillable=['id','animal_id','file_name'];
    
    public function animal()
    {
    	return $this->belongsTo('App\Animal');
    }
}
