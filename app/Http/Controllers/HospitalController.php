<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Hospital;
use App\AnimalHospital;
use App\AnimalImage;
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
        $hospitals = Hospital::All();
        return $hospitals;
    }

    public function detailHospital($hospitalId){
        $hospital = Hospital::find($hospitalId);
        $listRemove = [];
        $animalHospitals = AnimalHospital::orderBy('animal_id')->where('hospital_id', $hospitalId)->get();
        foreach ($animalHospitals as $key => $animalHospital) {
            $animalImage = AnimalImage::where('animal_id', $animalHospital->animal_id)->get();
            if(!$animalImage->isEmpty()){
                $animalHospitals[$key]['file_name'] = $animalImage[0]->file_name;          
            }
            if($key > 0 && $animalHospitals[$key-1]->animal_id == $animalHospital->animal_id){
                $listRemove[] = $key;
            }
        }
        if($listRemove){
            foreach ($listRemove as $key => $value) {
                unset($animalHospitals[$value]);
            }
        }

        return view('hospital/detail_info')->with('animal_hospitals', $animalHospitals)->with('hospital', $hospital);
    }

}