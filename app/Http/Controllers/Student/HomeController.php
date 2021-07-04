<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Classes;
use App\Models\Notify;
use Illuminate\Http\Request;
use App\Models\Timetable;
use App\Models\Student;
use Illuminate\Support\Facades\DB;
use Mockery\Matcher\Not;
use PHPUnit\Framework\MockObject\Builder\Stub;

class HomeController extends Controller
{
    public function index(){

        $student = Student::where("user_id",auth()->user()->id)->get();

        $notify = Notify::where("class_id", '=', $student[0]->class_id)
        ->where('status', '=', 0)
        ->get();
       
        $message_count = Notify::where('class_id', '=', $student[0]->class_id)
        ->where('status', '=', 0)
        ->count();
        
        $timetable = DB::select('SELECT d.day_name, se.semister_name,cl.class_name,s.start_time,s2.subject_name, r.room_name,s.end_time FROM timetables t 
        left join days d on t.day_id =d.id  
        left join semister se on t.semister_id =se.id  
        left join slots s on t.slots_id = s.id 
        left JOIN rooms r on t.room_id = r.id 
        left join subjects s2 on t.subject_id  = s2.id 
        left join class_subjects cs on s2.id=cs.subject_id
        left join students st on cs.class_id = st.id
        left JOIN classes cl on cs.class_id=cl.id WHERE st.id = '.$student[0]->class_id);
        return view('students.home', [
            'timetable'=>$timetable,
            'semister_name'=>$timetable[0]->semister_name,
            'count_msg'=>$message_count,
            'notify'=>$notify,
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
