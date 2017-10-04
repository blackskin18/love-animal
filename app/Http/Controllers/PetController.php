<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Status;
use App\Animal;
use App\AnimalCondition;

class PetController extends Controller
{
    public function test()
    {	
    	$a = Animal::All();
    	// var_dump($a);die;
        // echo "<pre>";
        // 	print_r($a);
        // echo "</pre>";
        return $a;
    }

    public function listAllPest() {
    	return view('list_pet.nav');
    }
}
