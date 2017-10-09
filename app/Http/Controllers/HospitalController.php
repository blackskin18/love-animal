<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\hospital;
use Illuminate\Support\Facades\DB;

class HospitalController extends Controller
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

    public function getListHospital()
    {
    	return view('hospital/list_hospital');
    }

    public function postListHospital()
    {
        $hospitals = hospital::All();
        return $hospitals;
    }

}