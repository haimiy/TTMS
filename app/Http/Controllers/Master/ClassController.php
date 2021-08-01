<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Models\Classes;
use App\Models\Department;
use App\Models\AcademicYear;
use App\Models\AcademicLevel;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\ClassesImport;
use App\Exports\ClassesExport;
use App\Models\ClassSubject;
use App\Models\Programme;
use App\Models\Subject;

class ClassController extends Controller
{
    public function index(){
        $academic_level = AcademicLevel::all();
        $academic_year = AcademicYear::all();
        $depts = Department::all();
        $subject = Subject::all();
        $programme = Programme::all();

        $classes = DB::select('SELECT GROUP_CONCAT(s.subject_name) subject_names, c.*,d.dept_name FROM classes c
        LEFT JOIN departments d ON d.id = c.dept_id
        LEFT JOIN class_subjects cs ON cs.class_id = c.id
        LEFT JOIN subjects s ON s.id = cs.subject_id GROUP BY c.id');

        return view('lecturers.master.class', [
            'classes'=>$classes,
            'depts'=>$depts,
            'subjects'=>$subject,
            'academic_levels'=>$academic_level,
            'academic_years'=>$academic_year,
         
        ]);

    }
    public function addModules(Request $request){
        $validator = Validator::make($request->all(),[
            'class_name'    => 'required',
            'dept_id'    => 'required',
            'subject_id'    => 'required',  
        ]);
        if(!$validator->passes()){
            return response()->json(['status'=>0, 'error'=>$validator->errors()->toArray()]);
        }else{
        $classes = Classes::where('class_code',$request->class_code)->get();    
        foreach($classes as $class){
            $cs =ClassSubject::where("subject_id",$request->subject_id)->where("class_id",$class->id)->get();
            if($cs->count()>0)
            return response()->json(['status'=>false, 'message'=>'Module has been already inserted!']);
            ClassSubject::create([
                "subject_id"=>$request->subject_id,
                "class_id"=>$class->id
            ]);
        }
        return response()->json(['status'=>true, 'message'=>'Module has been updated successful']);
    }
    }
    public function deleteModules(Request $request){
        $classes = Classes::where('class_code',$request->class_code)->get();  
        
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
                'class_code'    => 'required',
                'class_size'    => 'required',
                'dept_id'       => 'required',
                'programme_id'       => 'required',
                'academic_level_id' => 'required',
                'academic_year_id' => 'required'
            ]);
            if(!$validator->passes()){
                return response()->json(['status'=>0, 'error'=>$validator->errors()->toArray()]);
            }else{
                $class_names = explode(",",$request->class_name);
                $classes = null;
                $class_size = $request->class_size/count($class_names);
                $num = 0;
                foreach($class_names as $class_name){
                    if($num==0){
                        $request["class_size"] = ceil($class_size);
                        $request["class_name"] = $class_name;
                    $classes = Classes::where('id',$id)->update([
                        'class_name'    => $request->class_name,
                        'class_code'    => $request->class_code,
                        'class_size'   => $request->class_size,
                        'dept_id'     => $request->dept_id,
                        'academic_level_id' => $request->academic_level_id,
                        'academic_year_id' => $request->academic_year_id,
                        'programme_id'     => $request->programme_id,
    
                    ]);
                    }else{
                        //TODO: if class name is exist handle
                        $request["class_size"] = floor($class_size);
                        $request["class_name"] = $class_name;
                        $class_subjects = DB::select('SELECT cs.subject_id FROM classes c LEFT JOIN class_subjects cs ON cs.class_id = c.id WHERE c.id='.$id);
                        $class = Classes::create($request->all());
                        foreach($class_subjects as $class_subject){
                            ClassSubject::create([
                                "subject_id"=>$class_subject->subject_id,
                                "class_id"=>$class->id
                            ]);
                        }
                    }   
                    $num++;
                }
               
                if(!$classes){
                    return response()->json(['status'=>false, 'message'=>'Something went wrong']);
                }else{
                    return response()->json(['status'=>true, 'message'=>'Class info has been update successful']);
                }
            }
    }

    public function addClass(Request $req){
        $validator = Validator::make($req->all(),[
            'class_name'    => 'required',
            'class_code'    => 'required',
            'class_size'    => 'required',
            'dept_id'     => 'required',
            'academic_level_id' => 'required',
            'academic_year_id' => 'required',
            'programme_id' => 'required'
        ]);
        if(!$validator->passes()){
            return response()->json(['status'=>0, 'error'=>$validator->errors()->toArray()]);
        }else{
            $class_names = explode(",",$req->class_name);
            $classes = null;
            $class_size = $req->class_size/count($class_names);
            $num = 0;
            foreach($class_names as $class_name){
                if($num==0){
                    $req["class_size"] = ceil($class_size);
                }else{
                    $req["class_size"] = floor($class_size);
                }
                
                $req["class_name"] = $class_name;
                $classes = Classes::create($req->all());
                $num++;
            }
            
            if(!$classes){
                return response()->json(['status'=>0, 'msg'=>'Something went wrong']);
            }else{
                return response()->json(['status'=>1, 'msg'=>'You insert data successfull']);
            }
        }
    }

    public function selectClassesSubject(Request $request, $id){
        $class_subject = DB::select('SELECT s.subject_name from class_subjects cs
        LEFT JOIN subjects s ON s.id = cs.subject_id WHERE cs.class_id = '.$id);
        return response()->json([
            'class_subjects'=>$class_subject,
        ]);
    }

    public function selectDepartmentSubject($id){
        $subjects = Subject::where('dept_id',$id)->get();
        return response()->json([
            'subjects'=>$subjects,
        ]);
    }
    //TODO-Nta level 
    public function selectLevel($id){
        $academic_level = AcademicLevel::where('subject_id',$id)->get();
        return response()->json([
            'academic_levels'=>$academic_level,
        ]);
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
