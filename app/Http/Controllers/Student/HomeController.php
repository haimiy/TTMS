<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Classes;
use App\Models\Notify;
use App\Helper\Tt;
use Illuminate\Http\Request;
use App\Models\Timetable;
use App\Models\Student;
use App\Models\Day;
use App\Models\Slot;
use Illuminate\Support\Facades\DB;
use Mockery\Matcher\Not;
use PHPUnit\Framework\MockObject\Builder\Stub;

class HomeController extends Controller
{
    public function index(Request $request){
        $days = Day::all();
        $time = Slot::all();
        $student = Student::where("user_id",auth()->user()->id)->get();
        $notify = Notify::where("class_id", '=', $student[0]->class_id)
        ->where('status', '=', 0)
        ->get();

        $message_count = Notify::where('class_id', '=', $student[0]->class_id)
        ->where('status', '=', 0)
        ->count();

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
        left JOIN classes cl on cs.class_id=cl.id WHERE cl.id='.$student[0]->class_id);
        return view('students.home', [
            'classTimetable'=>Tt::test($classTimetable,$student[0]->class_id),
            'semister_name'=>$classTimetable[0]->semister_name,
            'count_msg'=>$message_count,
            'notify'=>$notify,
            'weekDays'=>$days,
            'timeslots'=>$time,
            'class_name'=>"No Class Timetable"
        ]);
    }

    public function readMessage(){
        $student = Student::where("user_id",auth()->user()->id)->get();
        DB::table('notify')
        ->where('status',0)
        ->where('status', '=', 0)
        ->where("class_id", '=', $student[0]->class_id)
        ->update(['status' => 1]);

        $message_count = Notify::where('class_id', '=', $student[0]->class_id)
        ->where('status', '=', 0)
        ->count();

         $notify = Notify::where("class_id", '=', $student[0]->class_id)
        ->where('status', '=', 0)
        ->get();

        $showReadMessage = DB::select('SELECT * FROM notify n
        LEFT JOIN users u ON u.id = n.lecturer_id
        WHERE n.status = 1 AND n.class_id = '.$student[0]->class_id);

        return view('students.view_message', [
            'showReadMessage'=>$showReadMessage,
            'count_msg'=>$message_count,
            'notify'=>$notify,
        ]);

    }

}
