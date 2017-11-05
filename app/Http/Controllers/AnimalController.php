<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Animal;
use App\AnimalImage;
use App\AnimalCondition;
use App\Status;
use App\AnimalFoster;
use App\UserRole;
use App\history;
use Illuminate\Database\Eloquent\Model;
use Redirect;
use Auth;
use App\Http\Requests\UploadRequest;
use App\Http\Controllers\HistoryController;
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

    public function getAnimalInfo($animalId) 
    {
        $images = Animal::find($animalId)->animalImage()->get();
        $animal = Animal::find($animalId);
        $allStatus = Status::all();
        $animalFosters = AnimalFoster::where('animal_id', $animalId)->get();
        $userId = Auth::user()->id;
        $userRole = UserRole::where('user_info_id', $userId)->get();
        $histories = History::where('animal_id', $animalId)->orderBy('created_at','desc')->get();
        foreach ($histories as $key => $value) {
            $histories[$key]->user;
        }

        return view('animal/detail_info')   ->with('animal',           $animal)
                                            ->with('images',            $images)
                                            ->with('histories',            $histories)
                                            ->with('all_status',        $allStatus)
                                            ->with('animal_fosters',    $animalFosters)
                                            ->with('user_level',        $userRole[0]->role_info_id);
    }


    public function editCreateAt(Request $request, $animalId)
    {
        $animal = Animal::find($animalId);

        $history = new HistoryController;
        $history->saveLog(Auth::User()->id, $animalId, 'create_at', $animal->created_at, $request->data, 'Sửa ngày nhận');
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

        $history = new HistoryController;
        $history->saveLog(Auth::User()->id, $animalId, 'address', $animal->address, $request->data, 'Sửa địa chỉ');
        
        $animal->address = $request->data;
        $animal->save();
        return $animal->address;
    }


    public function editName(Request $request, $animalId)
    {
        $animal = Animal::find($animalId);

        $history = new HistoryController;
        $history->saveLog(Auth::User()->id, $animalId, 'name', $animal->name, $request->data, 'Sửa Trường Hợp');

        $animal->name = $request->data;
        $animal->save();
        return $animal->name;
    }


    public function editType(Request $request, $animalId)
    {
        $animal = Animal::find($animalId);

        $history = new HistoryController;
        $history->saveLog(Auth::User()->id, $animalId, 'type', $animal->type, $request->data, 'Sửa loài');

        $animal->type = $request->data;
        $animal->save();
        return $animal->type;
    }

    public function editStatus (Request $request, $animalId)
    {
        $animal = Animal::find($animalId);

        $history = new HistoryController;


        $statuses = Status::all();

        foreach ($statuses as $key => $status) {
            if($status->id == $animal->status){
                $oldValue = $status->name;
            }
            if($status->id == $request->data){
                $newValue = $status->name;
            } 
        }
        $history->saveLog(Auth::User()->id, $animalId, 'status', $oldValue, $newValue, 'Sửa trạng thái');

        $animal->status = $request->data;
        $animal->save();

        return $newValue;
    }

    public function editDescription(Request $request, $animalId)
    {
        $animal = Animal::find($animalId);

        $history = new HistoryController;
        $history->saveLog(Auth::User()->id, $animalId, 'name', $animal->description, $request->data, 'Sửa mô tả');

        $animal->description = $request->data;
        $animal->save();
        return $animal->description;
    }

    public function editPlace(Request $request, $animalId)
    {
        $animal = Animal::find($animalId);

        $history = new HistoryController;
        $history->saveLog(Auth::User()->id, $animalId, 'name', $animal->place, $request->data, 'Sửa địa chỉ');

        $animal->place = $request->data;
        $animal->save();
        return $animal->place;
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

                $history = new HistoryController;
                $history->saveLog(Auth::User()->id, $request->animal_id, 'image', null, $filename, 'Thêm Ảnh');
            }
            return Redirect::to('/animal/detail_info/'.$request->animal_id);
        }
        return Redirect::to('/animal/detail_info/'.$request->animal_id);
    }

    public function deleteImage($imageId)
    {   
        $history = new HistoryController;

        $animalImage = AnimalImage::find($imageId);

        $animalId = $animalImage->animal_id;
        $fileName = $animalImage->file_name;

        $history->saveLog(Auth::User()->id, $animalId, 'image', $fileName, null, 'Xóa Ảnh');
        
        // File::Delete(public_path().'/animal_image/'.$animalId.'/'.$fileName);
        $animalImage->delete();
        return "true";
    }

    public function changeImage(Request $request, $imageId){

        $animalImage = AnimalImage::find($imageId);
        $animalId = $animalImage->animal_id;

        $file = $request->file('photo');
        $newFileName = $file->store('');
        $file->move(public_path().'/animal_image/'.$animalId, $newFileName);
        $fileName = $animalImage->file_name;
        $animalImage->file_name = $newFileName;
        $animalImage->save();

        $history = new HistoryController;
        $history->saveLog(Auth::User()->id, $animalId, 'image', $fileName, $newFileName, 'Thay Đổi Ảnh');

        return "true";
    }

    public function getSummaryDetail($animalId){

        $animal = Animal::find($animalId);
        $statuses = Status::all();
        foreach ($statuses as $key => $status) {
            if($status->id == $animal->status){
                $animal->status = $status->name;
            }
        }
        return $animal;
    }

    public function getAllStatus(){
        $statuses = Status::all();
        return $statuses;
    }

}
