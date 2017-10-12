<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Animal;
use App\AnimalImage;
use App\AnimalCondition;
use App\Status;
use App\AnimalFoster;
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
        $images = Animal::find($animalId)->animalImage()->get();
        $animal = Animal::find($animalId);
        $status = Status::find($animal->status);
        $animal_fosters = AnimalFoster::where('animal_id', $animalId)->get();
        // dd($animal_foster);
        // dd($animal);
        return view('animal/detail_info')->with('animal', $animal)->with('images', $images)->with('status',$status)->with('animal_fosters', $animal_fosters);
    }

}
