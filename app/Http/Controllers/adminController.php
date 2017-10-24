<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use App\User;
use App\RoleInfo;
use App\UserRole;
use App\Status;
use App\Animal;
use App\AnimalImage;
use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\CreateCaseRequest;
use Redirect;
use Auth;

class adminController extends Controller
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

    public function getCreateUser()
    {

        $userId = Auth::user()->id;
        $userRoles = UserRole::where('user_info_id', $userId)->get();
        foreach ($userRoles as $key => $userRole) {
            if($userRole->role_info_id == 3 || $userRole->role_info_id == 3){
                $roleInfos = RoleInfo::where('role_info_id', '>', 3)->get();
            } elseif($userRole->role_info_id == 1){
                $roleInfos = RoleInfo::all();
                break;
            }
        }

        return view('admin/create_user')->with('role_infos', $roleInfos);
    }

    public function postCreateUser(CreateUserRequest $request)
    {   
        $user = new User();
        $user->email = $request->email;
        $user->save();

        $userRole = new UserRole();
        $userRole->user_info_id = $user->id;
        $userRole->role_info_id = $request->level;
        $userRole->save();

        return Redirect::to('/admin/create_user');
    }

    public function getCreateCase()
    {   
        $statuses = Status::all();
        return view('admin/create_case')->with('statuses', $statuses);
    }

    public function postCreateCase(CreateCaseRequest $request)
    {
        // $request->name 
        $animal = new Animal();
        $animal->name = $request->name;
        $animal->status = $request->status;
        $animal->created_by = Auth::user()->id;
        if($request->description){
            $animal->description = $request->description;
        }
        if($request->note){
            $animal->note = $request->note;
        }
        if($request->address){
            $animal->address = $request->address;
        }
        if($request->age){
            $animal->age = $request->age;
        } else {
            $animal->age = 0;
        }
        if($request->type){
            $animal->type = $request->type;
        }
        $animal->save();

        if($request->photos){
            foreach ($request->photos as $photo) {
                $filename = $photo->store('');
                $file = $photo;
                $file->move(public_path().'/animal_image/'.$request->animal_id, $filename);
                
                $animalImage = new AnimalImage;
                $animalImage->animal_id = $animal->id;
                $animalImage->created_by = Auth::user()->id;
                $animalImage->file_name = $filename;
                $animalImage->save();
            }
        }

        return Redirect::to('/animal/detail_info/'.$animal->id);
    }

}
