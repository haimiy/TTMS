<?php

namespace App\Http\Controllers\Master;

use App\Helper\Tt;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Timetable;
use App\Models\Slot;
use App\Models\Day;
use App\Models\Subject;
use App\Models\Room;
use App\Models\Classes;
use App\Helper\Helper;
use PDF;
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
        Helper::generateTimetable();
        return back();
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

        $classTimetable = DB::select('SELECT d.day_name, d.id as day_id,se.semister_name,cl.class_name,s.start_time,s2.subject_name,s2.credit_no, s.id as slot_id,s.end_time,s2.subject_code,CONCAT(u.first_name,CONCAT(" ",u.last_name)) as lecturer_name,r.room_name  FROM timetables t
        left join days d on t.day_id =d.id
        left join semister se on t.semister_id =se.id
        left join slots s on t.slots_id = s.id
        left JOIN rooms r on t.room_id = r.id
        left join subjects s2 on t.subject_id  = s2.id
        left join class_subjects cs on s2.id=cs.subject_id
        left JOIN lecturer_subjecs ls on s2.id=ls.subject_id
        left join lecturers l on ls.lecturer_id = l.id
        left join users u on l.user_id = u.id
        left JOIN classes cl on cs.class_id=cl.id WHERE cl.id='.$request->class_id);

        if (count($classTimetable)==0)
            return view('lecturers.master.tt', [
                'classTimetable'=>$classTimetable,
                'weekDays'=>$days,
                'timeslots'=>$time,
                'class_name'=>"No Class Timetable"
            ]);
//        return Tt::test($classTimetable,$request->class_id);
        return view('lecturers.master.tt', [
            'classTimetable'=>Tt::test($classTimetable,$request->class_id),
            'weekDays'=>$days,
            'timeslots'=>$time,
            'class_name'=>$classTimetable[0]->class_name
        ]);
    }
    protected function downloadTimetable()
    {
        $days = Day::all();
        $time = Slot::all();
        $classes_timetables = [];
        $classes = DB::select("select DISTINCT c.class_name, c.id as class_id from timetables t left join subjects s on t.subject_id left join class_subjects cs on s.id = cs.subject_id
				left join classes c on cs.class_id =c.id ");
//        return $classes;
        foreach ($classes as $class){
        $classTimetable = DB::select('SELECT d.day_name, d.id as day_id,se.semister_name,cl.class_name,s.start_time,s2.subject_name,s2.credit_no, s.id as slot_id,s.end_time,s2.subject_code,CONCAT(u.first_name,CONCAT(" ",u.last_name)) as lecturer_name,r.room_name  FROM timetables t
        left join days d on t.day_id =d.id
        left join semister se on t.semister_id =se.id
        left join slots s on t.slots_id = s.id
        left JOIN rooms r on t.room_id = r.id
        left join subjects s2 on t.subject_id  = s2.id
        left join class_subjects cs on s2.id=cs.subject_id
        left JOIN lecturer_subjecs ls on s2.id=ls.subject_id
        left join lecturers l on ls.lecturer_id = l.id
        left join users u on l.user_id = u.id
        left JOIN classes cl on cs.class_id=cl.id WHERE cl.id='.$class->class_id);

        $data["class_name"] = $class->class_name;
        $data["classTimetable"] = Tt::test($classTimetable,$class->class_id);
        array_push($classes_timetables,$data);
        }
        $pdf = PDF::loadView('lecturers.master.timetable_pdf',[
            'classes'=>$classes_timetables,
            'weekDays'=>$days,
            'timeslots'=>$time,
        ]);
        return $pdf->setPaper('a4', 'landscape')->download('timetable.pdf');
        return view('lecturers.master.timetable_pdf', [
            'classes'=>$classes_timetables,
            'weekDays'=>$days,
            'timeslots'=>$time,
        ]);
    }
    public function timetableUi(){
        return view('lecturers.master.generate');
    }
}
