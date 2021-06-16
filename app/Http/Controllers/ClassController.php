<?php

namespace App\Http\Controllers;

use App\Models\Classes;
use App\Models\Department;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ClassController extends Controller
{
    public function index(){
        $depts = Department::all();
        $classes =  DB::table('classes')
        ->join ('departments', 'departments.id', '=', 'classes.dept_id' )
        ->select('classes.*', 'dept_name')
        ->get();
        return view('lecturers.master.class', ['classes'=>$classes,'depts'=>$depts]);

    }

    public function getAjaxClassesInformation(){
        $classes = Classes::all();
        return response()->json([
            "status"=>true,
            "classes"=>$classes,
        ]);

    }

    public function addClass(Request $req){
        $validator = Validator::make($req->all(),[
            'class_name'    => 'required',
            'class_size'    => 'required',
            'dept_name'     => 'required'
        ]);
        if(!$validator->passes()){
            return response()->json(['status'=>0, 'error'=>$validator->errors()->toArray()]);
        }else{
            $query = $req->input();
                $class = new Classes;
                $dept = new Department;
                $class->class_name = $query['class_name'];
                $class->class_size = $query['class_size'];
                $class->dept_id = $query['dept_name'];
                $class->save();
              
            if(!$query){
                return response()->json(['status'=>0, 'msg'=>'Something went wrong']);
            }else{
                return response()->json(['status'=>1, 'msg'=>'Your pfofile info has been update']);
            }
        }
    }
}
