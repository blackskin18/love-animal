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
        return $animals;
    }
}
