<?php

namespace App\Http\Controllers\Coordinator;

use App\Http\Controllers\Controller;
use App\Models\Classes;
use App\Models\Department;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\ClassesImport;
use App\Exports\ClassesExport;

class ClassController extends Controller
{
    public function index(){
        $depts = Department::all();
        $classes =  DB::table('classes')
        ->join ('departments', 'departments.id', '=', 'classes.dept_id' )
        ->select('classes.*', 'dept_name')
        ->get();
        return view('lecturers.coordinator.class', ['classes'=>$classes,'depts'=>$depts]);

    }

    public function getAjaxClassesInformation(){
        $Classes = Classes::all();
        return response()->json([
            "status"=>true,
            "Classes"=>$Classes,
        ]);

    }

    public function getAjaxClassInformation($id){
        $class = Classes::find($id);

        return response()->json([
            "status"=>true,
            "class"=>$class,
        ]);
    }
    
    public function deleteAjaxClassesInformation($id): \Illuminate\Http\JsonResponse
    {
        $class = Classes::find($id);
        $class->delete();
        return response()->json(['status'=>true, 'message'=>'Class Deleted Successful!']);
    }

    public function editAjaxClassesInformation(Request $request, $id){
            $validator = Validator::make($request->all(),[
                'class_name'    => 'required',
                'class_size'    => 'required',
                'dept_id'     => 'required'
            ]);
            if(!$validator->passes()){
                return response()->json(['status'=>0, 'error'=>$validator->errors()->toArray()]);
            }else{
                $query = Classes::where('id',$id)->update([
                    'class_name'    => $request->class_name,
                    'class_size'   => $request->class_size,
                    'dept_id'     => $request->dept_id,

                ]);
                if(!$query){
                    return response()->json(['status'=>false, 'message'=>'Something went wrong']);
                }else{
                    return response()->json(['status'=>true, 'message'=>'Class info has been update successful']);
                }
            }
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
                return response()->json(['status'=>1, 'msg'=>'You insert data successfull']);
            }
        }
    }

    public function import(Request $request) 
    {
        Excel::import(new ClassesImport, $request->file('file')->store('temp'));
        return back();
    }
    public function export() 
    {
        return Excel::download(new ClassesExport, 'classes.xlsx');
    }
}
