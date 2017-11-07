<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use App\History;
use App\Status;
use App\AnimalFoster;
use App\AnimalHospital;
use Carbon\Carbon;

class HistoryController extends Controller
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

    public function saveLog($userId, $animalId, $attribute, 
                            $oldValue, $newValue, $note)
    {
        $history = new History;
        $history->user_id = $userId;
        if($animalId){
            $history->animal_id = $animalId;
        }
        if($attribute){
            $history->attribute = $attribute;
        }
        if($oldValue){
            $history->old_value = $oldValue;
        }
        if($newValue){
            $history->new_value = $newValue;
        }
        if($note){
            $history->note = $note;
        }
        $history->save();
    }

    public function getViewListHistory() 
    {
        return view('history/list_history');
    }

    public function apigetDataHistory() 
    {
        $histories = History::orderBy('created_at','desc')->get();
        foreach ($histories as $key => $value) {
            $histories[$key]->user;
            if($histories[$key]->attribute == 'place'){
                $placeResult = null;
                if($histories[$key]->old_value && $histories[$key]->old_value == 'hospital'){
                    $place = AnimalHospital::where('animal_id', $histories[$key]->animal_id)->orderBy('created_at', 'desc')->take(1)->get();
                    $place[0]->hospital;
                    $histories[$key]['old_value_place'] =  $place[0];
                } elseif($histories[$key]->old_value == 'volunteer'){
                    $place = AnimalFoster::where('animal_id', $histories[$key]->animal_id)->orderBy('created_at', 'desc')->take(1)->get();
                    $place[0]->foster;
                    $histories[$key]['old_value_place'] =  $place[0];
                }

                if($histories[$key]->new_value && $histories[$key]->new_value == 'hospital'){
                    $place = AnimalHospital::where('animal_id', $histories[$key]->animal_id)->orderBy('created_at', 'desc')->take(1)->get();
                    $place[0]->hospital;
                    $histories[$key]['new_value_place'] =  $place[0];
                } elseif($histories[$key]->new_value == 'volunteer'){
                    $place = AnimalFoster::where('animal_id', $histories[$key]->animal_id)->orderBy('created_at', 'desc')->take(1)->get();
                    $place[0]->foster;
                    $histories[$key]['new_value_place'] =  $place[0];
                }

            }
        }
        return $histories;
    }

    public function apigetDataHistoryInToday()
    {
        $today =Carbon::today();
        $histories = History::where('created_at', '>', $today)->orderBy('created_at','desc')->get();
        foreach ($histories as $key => $value) {
            $histories[$key]->user;
            if($histories[$key]->attribute == 'place'){
                $placeResult = null;
                if($histories[$key]->old_value && $histories[$key]->old_value == 'hospital'){
                    $place = AnimalHospital::where('animal_id', $histories[$key]->animal_id)->orderBy('created_at', 'desc')->take(1)->get();
                    $place[0]->hospital;
                    $histories[$key]['old_value_place'] =  $place[0];
                } elseif($histories[$key]->old_value == 'volunteer'){
                    $place = AnimalFoster::where('animal_id', $histories[$key]->animal_id)->orderBy('created_at', 'desc')->take(1)->get();
                    $place[0]->foster;
                    $histories[$key]['old_value_place'] =  $place[0];
                }

                if($histories[$key]->new_value && $histories[$key]->new_value == 'hospital'){
                    $place = AnimalHospital::where('animal_id', $histories[$key]->animal_id)->orderBy('created_at', 'desc')->take(1)->get();
                    $place[0]->hospital;
                    $histories[$key]['new_value_place'] =  $place[0];
                } elseif($histories[$key]->new_value == 'volunteer'){
                    $place = AnimalFoster::where('animal_id', $histories[$key]->animal_id)->orderBy('created_at', 'desc')->take(1)->get();
                    $place[0]->foster;
                    $histories[$key]['new_value_place'] =  $place[0];
                }

            }
        }
        return $histories;

    }

}
