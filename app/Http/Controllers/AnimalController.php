<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Animal;
use App\AnimalImage;
use App\AnimalCondition;
use Illuminate\Database\Eloquent\Model;

class AnimalController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function test()
    {	
    	$a = Animal::All();
    	// var_dump($a);die;
        // echo "<pre>";
        // 	print_r($a);
        // echo "</pre>";
        return $a;
    }

    public function animalInfo($animalId) {
        $animal = Animal::find($animalId)->animalImage()->with('animal')->get();
        $a = Animal::find(2);
        return $animal;
    }

}
