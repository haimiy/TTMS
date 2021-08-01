<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Subject;
use Illuminate\Support\Facades\DB;
use App\Models\AcademicLevel;
use App\Models\Department;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\SubjectsImport;
use App\Exports\SubjectsExport;

class SubjectController extends Controller
{
    public function index(){
        $subject = Subject::all();
        $depts = Department::all();
        $academic_level = AcademicLevel::all();
        return view('lecturers.master.subject', [
            'subjects'=>$subject,
            'academic_levels'=>$academic_level,
            'depts'=>$depts,
        ]);

    }
    public function getAjaxSubjectsInformation(){
        $Subjects = Subject::all();
        return response()->json([
            "status"=>true,
            "Subjects"=>$Subjects,
        ]);

    }
    
    public function getAjaxsubjectInformation($id){
        $subject = Subject::find($id);

        return response()->json([
            "status"=>true,
            "subject"=>$subject,
        ]);
    }
    public function deleteAjaxSubjectInformation($id): \Illuminate\Http\JsonResponse
    {
        $subject = Subject::find($id);
        $subject->delete();
        return response()->json(['status'=>true, 'message'=>'subject Deleted Successful!']);
    }

    public function editAjaxSubjectInformation(Request $request, $id){
            $validator = Validator::make($request->all(),[
                'subject_name'    => 'required',
                'subject_code'    => 'required',
                'credit_no'     => 'required',
                'dept_id'       => 'required',
                'academic_level_id' => 'required',
            ]);
            if(!$validator->passes()){
                return response()->json(['status'=>0, 'error'=>$validator->errors()->toArray()]);
            }else{
                $query = Subject::where('id',$id)->update([
                    'subject_name'    => $request->subject_name,
                    'subject_code'   => $request->subject_code,
                    'credit_no'     => $request->credit_no,
                    'dept_id'     => $request->dept_id,
                    'academic_level_id' => $request->academic_level_id,

                ]);
                if(!$query){
                    return response()->json(['status'=>false, 'message'=>'Something went wrong']);
                }else{
                    return response()->json(['status'=>true, 'message'=>'subject info has been update successful']);
                }
            }
    }

    public function addSubject(Request $req){
        $validator = Validator::make($req->all(),[
            'subject_name'    => 'required',
            'subject_code'    => 'required',
            'credit_no'     => 'required',
            'dept_id'       => 'required',
            'academic_level_id' => 'required',
        ]);
        if(!$validator->passes()){
            return response()->json(['status'=>0, 'error'=>$validator->errors()->toArray()]);
        }else{
            $query=Subject::create($req->all());
            if(!$query){
                return response()->json(['status'=>0, 'msg'=>'Something went wrong']);
            }else{
                return response()->json(['status'=>1, 'msg'=>'You insert data successfull']);
            }
        }
    }
    public function import(Request $request) 
    {
        Excel::import(new SubjectsImport, $request->file('file')->store('temp'));
        return back();
    }
    public function export() 
    {
        return Excel::download(new SubjectsExport, 'subjects.xlsx');
    }
}
