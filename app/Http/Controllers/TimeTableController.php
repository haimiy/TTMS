<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Timetable;
use App\Models\Slot;
use App\Models\Day;
use App\Models\Subject;
use App\Models\Room;
use App\Models\Classes;
use App\Helper\Helper;

class TimeTableController extends Controller
{
    public function timetable(){
        $rooms = Room::all();
        $slots = Slot::all();
        $days = Day::all();


        foreach($days as $day){
            foreach($rooms as $room){
                foreach($slots as $slot){
                    Helper::timetableGenerate($day,$room,$slot);
                }
            }
        }

        return "Generated!";
    }


    public function test()
    {
        $val =Helper::generateTimetable();
        return $val;
    }
}
