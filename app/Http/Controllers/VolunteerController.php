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

    public function editInfo(Request $request, $userId)
    {   
        $userInfo = $request->data;
        $user = User::find($userId);
        if($userInfo['note'] != null && $user->email !=  $userInfo['note']){
            $user->note = $userInfo['note'];
        }
        if($userInfo['name'] != null && $user->email !=  $userInfo['name']){
            $user->name = $userInfo['name'];
        }
        if($userInfo['email'] != null && $user->email !=  $userInfo['email']){
            $user->email = $userInfo['email'];
        }
        if($userInfo['phone'] != null && $user->email !=  $userInfo['phone']){
            $user->phone = $userInfo['phone'];
        }
        if($userInfo['address'] != null && $user->email !=  $userInfo['address']){
            $user->address = $userInfo['address'];
        }
        if($userInfo['gender'] != null && $user->email !=  $userInfo['gender']){
            $user->gender = $userInfo['gender'];
        }
        $user->save();
        
        return $user;
        // return $user;
    }

}