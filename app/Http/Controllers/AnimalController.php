<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Animal;
use App\AnimalImage;
use App\AnimalCondition;
use App\Status;
use App\AnimalFoster;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

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

    public function animalInfo($animalId) 
    {
        $images = Animal::find($animalId)->animalImage()->get();
        $animal = Animal::find($animalId);
        $allStatus = Status::all();
        $animalFosters = AnimalFoster::where('animal_id', $animalId)->get();
        // dd($animal_foster);
        // dd($animal);
        return view('animal/detail_info')->with('animal', $animal)->with('images', $images)->with('all_status',$allStatus)->with('animal_fosters', $animalFosters);
    }


    public function editCreateAt(Request $request, $animalId)
    {
        $animal = Animal::find($animalId);
        $animal->created_at = $request->data;
        $animal->save();
        return $animal->created_at;
    }

    // public function editStatus(Request $request, $animalId)
    // {
    //     $animal = Animal::find($animalId);
    //     $animal->status = $request->data;
    //     $animal->save();
    //     return $animal->
    // }


    public function editAddress(Request $request, $animalId)
    {
        $animal = Animal::find($animalId);
        $animal->address = $request->data;
        $animal->save();
        return $animal->address;
    }


    public function editName(Request $request, $animalId)
    {
        $animal = Animal::find($animalId);
        $animal->name = $request->data;
        $animal->save();
        return $animal->name;
    }


    public function editType(Request $request, $animalId)
    {
        $animal = Animal::find($animalId);
        $animal->type = $request->data;
        $animal->save();
        return $animal->type;
    }


    public function editDescription(Request $request, $animalId)
    {
        $animal = Animal::find($animalId);
        $animal->description = $request->data;
        $animal->save();
        return $animal->description;
    }


}
