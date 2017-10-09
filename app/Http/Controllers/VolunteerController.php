<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\DB;

class VolunteerController extends Controller
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

    public function getListVolunteer()
    {
    	return view('volunteer/list_volunteer');
    }

    public function postListVolunteer()
    {
        $hospitals = User::All();
        return $hospitals;
    }

    public function volunteerInfo($user_id)
    {
        $user = User::find($user_id);
        // return $user;
        return view('volunteer/detail_info')->with('user',$user);
    }

}