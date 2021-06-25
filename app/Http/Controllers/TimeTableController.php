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
    public function test(){
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


    public function timetable()
    {
        $val = Helper::generateTimetable();
        return $val;
    }

    public function index(){
        $classes = Classes::all();
        $semister = DB::table('semister')->select('*')->get();
        return view('lecturers.master.timetable', [
            'classes'=>$classes,
            'semisters'=>$semister
        ]);
    }

    public function showClassTimetable(Request $request){
        $days = Day::all();
        $time = Slot::all();

        $classTimetable = DB::select('SELECT d.day_name,cl.class_name,s.start_time,s2.subject_name,s2.credit_no ,s.end_time FROM timetables t 
        left join days d on t.day_id =d.id  
        left join slots s on t.slots_id = s.id 
        left JOIN rooms r on t.room_id = r.id 
        left join subjects s2 on t.subject_id  = s2.id 
        left join class_subjects cs on s2.id=cs.subject_id 
        left JOIN classes cl on cs.class_id=cl.id WHERE cl.id='.$request->class_id);
        
        
        return view('lecturers.master.tt', [
            'classTimetable'=>$classTimetable,
            'weekDays'=>$days,
            'timeslots'=>$time,
            'class_name'=>$classTimetable[0]->class_name
        ]);
    }
}
