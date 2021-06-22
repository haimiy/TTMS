<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Subject;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class SubjectController extends Controller
{
    public function index(){
        $subject = Subject::all();
        return view('lecturers.master.subject', ['subjects'=>$subject]);

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
                'credit_no'     => 'required'
            ]);
            if(!$validator->passes()){
                return response()->json(['status'=>0, 'error'=>$validator->errors()->toArray()]);
            }else{
                $query = Subject::where('id',$id)->update([
                    'subject_name'    => $request->subject_name,
                    'subject_code'   => $request->subject_code,
                    'credit_no'     => $request->credit_no,

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
            'credit_no'     => 'required'
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
}
