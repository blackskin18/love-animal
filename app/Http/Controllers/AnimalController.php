<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Animal;
use App\AnimalImage;
use App\AnimalCondition;
use App\Status;
use App\AnimalFoster;
use App\UserRole;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Redirect;
use Auth;
use App\Http\Requests\UploadRequest;
use File;

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
        $this->middleware('system_admin');
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

    public function getAnimalInfo($animalId) 
    {
        $images = Animal::find($animalId)->animalImage()->get();
        $animal = Animal::find($animalId);
        $allStatus = Status::all();
        $animalFosters = AnimalFoster::where('animal_id', $animalId)->get();
        $userId = Auth::user()->id;
        $userRole = UserRole::where('user_info_id', $userId)->get();

        return view('animal/detail_info')   ->with('animal',           $animal)
                                            ->with('images',            $images)
                                            ->with('all_status',        $allStatus)
                                            ->with('animal_fosters',    $animalFosters)
                                            ->with('user_level',        $userRole[0]->role_info_id);
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

    public function postAddImage(UploadRequest $request)
    {   
        if($request->photos){
            foreach ($request->photos as $photo) {
                $filename = $photo->store('');
                $file = $photo;
                $file->move(public_path().'/animal_image/'.$request->animal_id, $filename);
                
                $animalImage = new AnimalImage;
                $animalImage->animal_id = $request->animal_id;
                $animalImage->created_by = Auth::user()->id;
                $animalImage->file_name = $filename;
                $animalImage->save();

            }
            return Redirect::to('/animal/detail_info/'.$request->animal_id);
        }
        return Redirect::to('/animal/detail_info/'.$request->animal_id);
    }

    public function deleteImage($imageId)
    {   
        $animalImage = AnimalImage::find($imageId);
        // dd($animalImage);
        $animalId = $animalImage->animal_id;
        $fileName = $animalImage->file_name;
        File::Delete(public_path().'/animal_image/'.$animalId.'/'.$fileName);
        $animalImage->delete();
        return "true";
    }

    public function changeImage(Request $request, $imageId){
        $animalImage = AnimalImage::find($imageId);
        $animalId = $animalImage->animal_id;
        $fileName = $animalImage->file_name;
        
        File::Delete(public_path().'/animal_image/'.$animalId.'/'.$fileName);
        $file = $request->file('photo');
        $file->move(public_path().'/animal_image/'.$animalId, $fileName);

        return "true";
    }

}
