<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Classes;
use App\Models\Lecturer;
use App\Models\Notify;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;


class HomeController extends Controller
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

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $count_classes= DB::table('classes')->get()->count();
        $count_subjects = DB::table('subjects')->get()->count();
        $count_rooms = DB::table('rooms')->get()->count();
        $count_lecturers = DB::table('lecturers')->get()->count();
        return view('lecturers.master.home', compact('count_classes', 'count_subjects','count_rooms', 'count_lecturers'));
    }

    public function notify(){
        $class = Classes::all();
        return view('lecturers.master.notify', ['classes'=>$class]);
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
