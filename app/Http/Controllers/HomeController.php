<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Animal;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
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

    public function getList($attribute, $value)
    {
        $animals = DB::table('animals')
                    ->join('animal_images', 'animals.id', '=', 'animal_images.animal_id')
                    ->join('animal_status_histories', 'animals.id', '=', 'animal_status_histories.animal_id')
                    ->join('statuses', 'animal_status_histories.status_id', 'statuses.id', '=')
                    ->select('animals.*', 'animal_images.file_name', 'statuses.name as status'  )
                    ->where($attribute, $value)
                    ->get();

        foreach ($animals as $key => $animal) {
            if($key != 0 && $animals[$key-1]->id == $animals[$key]->id ){
                $a[] = $key;
            }
        }
        if(isset($a)){
            foreach ($a as $key => $b) {
                unset($animals[$b]);
            }
        }
        return $animals;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        return view('home');
    }

    public function postListPet()
    {
        $animals = DB::table('animals')
                    ->join('animal_images', 'animals.id', '=', 'animal_images.animal_id')
                    ->join('animal_status_histories', 'animals.id', '=', 'animal_status_histories.animal_id')
                    ->join('statuses', 'animal_status_histories.status_id', 'statuses.id', '=')
                    ->select('animals.*', 'animal_images.file_name', 'statuses.name as status'  )
                    ->get();

        foreach ($animals as $key => $animal) {
            if($key != 0 && $animals[$key-1]->id == $animals[$key]->id ){
                $a[] = $key;
            }
        }
        if(isset($a)){
            foreach ($a as $key => $b) {
                unset($animals[$b]);
            }
        }
        return $animals;
    }

    public function getListInCommonHome()
    {
        return view('animal/list_in_common_home');
    }

    public function postListInCommonHome()
    {
        $animals = $this->getList('animals.address','nhà chung');
        return $animals;
    }

    public function getListReadyToFindTheOwner()
    {
        return view('animal/list_ready_to_find_the_owner');
    }

    public function postListReadyToFindTheOwner()
    {
        $animals = $this->getList('statuses.id',2);
        return $animals;
    }

    public function getListHasOwner()
    {
        return view('animal/list_has_owner');
    }
    public function postListHasOwner()
    {
        $animals = $this->getList('statuses.id',3);
        return $animals;
    }

    public function getListDie ()
    {
        return view('animal/list_die');
    }
    public function postListDie()
    {
        $animals = $this->getList('statuses.id',4);
        return $animals;
    }

}