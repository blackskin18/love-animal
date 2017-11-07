<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\UserRole;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\ChangePhotoRequest;
use Redirect;
use File;
use Auth;

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
        $levers = UserRole::where('user_info_id', Auth::user()->id)->get();
        $lever = 100;
        foreach ($levers as $key => $value) {
            if($value->role_info_id < $lever){
                $lever = $value->role_info_id;
            }
        }
        return view('volunteer/detail_info')->with('user',$user)->with('lever', $lever);
    }

    public function editInfo(Request $request, $userId)
    {   
        if($userId != Auth::User()->id){
            return;
        } else {
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
        }
        
        return $user;
    }

    public function changeAvatar(ChangePhotoRequest $request, $userId)
    {   
        if($userId != Auth::User()->id){
        } else {
            $user = User::find(Auth::User()->id);
            if(!$user->avatar){
                $avatar = $request->file('photo');
                $fileName = $avatar->store('');
                $avatar->move(public_path().'/avatar/'.$user->id, $fileName);

                $user->avatar = $fileName;
                $user->save();
            } else {
                $fileName = $user->avatar;
                File::Delete(public_path().'/avatar/'.$user->id.'/'.$fileName);
                $avatar = $request->file('photo');
                $avatar->move(public_path().'/avatar/'.$user->id, $fileName);
            }
        }
        return Redirect::to('/volunteer/info/'.$userId);
    }

    public function getAllVolunteer()
    {
        
    }

}