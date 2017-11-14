<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\UserRole;
use App\RoleInfo;
use App\AnimalFoster;
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
        $userId = Auth::user()->id;
        $userRoles = UserRole::where('user_id', $userId)->get();
        $level = 100;
        foreach ($userRoles as $key => $userRole) {
            if($userRole->role_id < $level){
                $level = $userRole->role_id;
            }
        }

        $user = User::All();
        return ['volunteers' => $user, 'user_level' => $level];
    }

    public function volunteerInfo($user_id)
    {   
        $user = User::find($user_id);
        // return $user;
        $levers = UserRole::where('user_id', Auth::user()->id)->get();
        $level = 100;
        foreach ($levers as $key => $value) {
            if($value->role_id < $level){
                $level = $value->role_id;
            }
        }

        $userId = Auth::user()->id;
        $userRoles = UserRole::where('user_id', $userId)->get();
        foreach ($userRoles as $key => $userRole) {
            if($userRole->role_id == 3 || $userRole->role_id == 3){
                $roleInfos = RoleInfo::where('role_id', '>', 3)->get();
            } elseif($userRole->role_id == 1){
                $roleInfos = RoleInfo::all();
                break;
            }
        }

        $roleOfUsers = UserRole::where('user_id', $user_id)->get();
        foreach ($roleOfUsers as $key => $userRole) {
            $userRole->role;
        }

        return view('volunteer/detail_info')->with('user',$user)->with('level', $level)->with('role_infos', $roleInfos)->with('user_roles', $roleOfUsers);
    }

    public function editInfo(Request $request, $userId)
    {   
        $levers = UserRole::where('user_id', Auth::user()->id)->get();
        $level = 100;
        foreach ($levers as $key => $value) {
            if($value->role_id < $level){
                $level = $value->role_id;
            }
        }

        if($userId == Auth::User()->id OR $level <= 3) {
            $userInfo = $request->data;
            $user = User::find($userId);
            if($userInfo['note'] != null && $user->note !=  $userInfo['note']){
                $user->note = $userInfo['note'];
            }
            if($userInfo['name'] != null && $user->name !=  $userInfo['name']){
                $user->name = $userInfo['name'];
            }
            if($userInfo['email'] != null && $user->email !=  $userInfo['email']){
                $user->email = $userInfo['email'];
            }
            if($userInfo['phone'] != null && $user->phone !=  $userInfo['phone']){
                $user->phone = $userInfo['phone'];
            }
            if($userInfo['address'] != null && $user->address !=  $userInfo['address']){
                $user->address = $userInfo['address'];
            }
            if($userInfo['gender'] != null && $user->gender !=  $userInfo['gender']){
                $user->gender = $userInfo['gender'];
            }
            $user->save();

            if($userInfo['user_roles'] != null and $level <=3 ){
                $oldUserRoles = UserRole::where('user_id', $userId)->get();
                foreach ($oldUserRoles as $key => $value) {
                    $value->delete();
                }

                $newUserRoles = $userInfo['user_roles'];
                foreach ($newUserRoles as $key => $value) {
                    $userRole = new UserRole();
                    $userRole->user_id = $userId;
                    $userRole->role_id = $value;
                    $userRole->save();
                }
            }
            
            
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

    public function deleteUser($userId){
        $user = User::find($userId);
        $user->delete();
        return 'true';
    }

    public function getListOwner(){
        return view('volunteer/list_owner');
    }

    public function postListOwner(){
        $userId = Auth::user()->id;
        $userRoles = UserRole::where('user_id', $userId)->get();
        $level = 100;
        foreach ($userRoles as $key => $userRole) {
            if($userRole->role_id < $level){
                $level = $userRole->role_id;
            }
        }

        // $user = User::All();
        $user =  DB::table('users')
                    ->leftJoin('user_roles', 'users.id', '=', 'user_roles.user_id')
                    ->leftJoin('role_infos', 'user_roles.role_id', '=', 'role_infos.id')
                    ->where('role_infos.id', 8)
                    ->get();

        return ['volunteers' => $user, 'user_level' => $level];
    }


}