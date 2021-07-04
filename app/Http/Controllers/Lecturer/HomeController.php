<?php

namespace App\Http\Controllers\Lecturer;

use App\Http\Controllers\Controller;
use App\Models\Classes;
use App\Models\Lecturer;
use App\Models\Notify;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class HomeController extends Controller
{
    public function index(){
        $lecturer = Lecturer::where("user_id",auth()->user()->id)->get();
        $timetable = DB::select('SELECT d.day_name, se.semister_name,cl.class_name,s.start_time,s2.subject_name, r.room_name,s.end_time FROM timetables t 
        left join days d on t.day_id = d.id  
        left join semister se on t.semister_id =se.id  
        left join slots s on t.slots_id = s.id 
        left JOIN rooms r on t.room_id = r.id 
        left join subjects s2 on t.subject_id  = s2.id 
        left join class_subjects cs on s2.id=cs.subject_id
        left JOIN classes cl on cs.class_id=cl.id
        LEFT JOIN lecturer_subjecs ls ON s2.id = ls.subject_id
        LEFT JOIN lecturers l ON s2.id = ls.subject_id WHERE l.id = '.$lecturer[0]->id);
        return view('lecturers.normal_lecturer.home', [
            'timetable'=>$timetable
        ]);
            
    }
    public function notify(){
        $class = Classes::all();
        return view('lecturers.normal_lecturer.notify', ['classes'=>$class]);
    }
    public function sendMessage(Request $request){
        $validator = Validator::make($request->all(), [
            'message'    => 'required',
            'class_id'   => 'required',
        ]);
        if(!$validator->passes()){
            return response()->json(['status'=>0, 'error'=>$validator->errors()->toArray()]);
        }else{
            $notification = new Notify();
            $notification->lecturer_id = Auth::user()->id;
            $notification->message = $request['message'];
            $notification->class_id = $request['class_id'];
            $notification->save();
            if (!$notification) {
                return response()->json(['status' => 0, 'msg' => 'Something went wrong']);
            } else {
                return response()->json(['status' => 1, 'msg' => 'Message sent successfully!']);
            }
        }
        
    }
}
