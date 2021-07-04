<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\LecturerRole;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Department;
use Illuminate\Http\Response;
use App\Models\Notify;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;


class StudentProfileController extends Controller
{
    public function showStudentProfile($id){
        $student = Student::where("user_id",auth()->user()->id)->get();
        $notify = Notify::where("class_id", '=', $student[0]->class_id)
        ->where('status', '=', 0)
        ->get();
       
        $message_count = Notify::where('class_id', '=', $student[0]->class_id)
        ->where('status', '=', 0)
        ->count();
                                                                                                                                                                                                                    
        $stud = DB::select('SELECT s.id,s.user_id,u.* FROM students s 
        LEFT JOIN users u ON u.id=s.user_id 
        WHERE u.id=' . $id . '');
        return view('students.profile', [
            'count_msg'=>$message_count,
            'notify'=>$notify,
            'stud'=>$stud[0],
        ]);
    }
    public function updateUserProfile(Request $req, $id)
    {
        $validator = Validator::make($req->all(), [
            'first_name'    => 'required',
            'middle_name'   => 'required',
            'last_name'     => 'required',
            'email'         => 'required|email',
            'phone_no'      => 'required',
            'dob'           => 'required',
            'gender'        => 'required'
        ]);
        if (!$validator->passes()) {
            return response()->json(['status' => 0, 'error' => $validator->errors()->toArray()]);
        } else {
            $query = User::find($id)->update([
                'first_name'    => $req->first_name,
                'middle_name'   => $req->middle_name,
                'last_name'     => $req->last_name,
                'email'         => $req->email,
                'phone_no'      => $req->phone_no,
                'dob'           => $req->dob,
                'gender'        => $req->gender,

            ]);
            if (!$query) {
                return response()->json(['status' => 0, 'msg' => 'Something went wrong']);
            } else {
                return response()->json(['status' => 1, 'msg' => 'Your pfofile info has been update']);
            }
        }
    }
    public function changePassword(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'oldPassword'    => [
                    'required', function ($attribute, $value, $fail) {
                        if (!Hash::check($value, Auth::user()->password)) {
                            return $fail(_('The current password is incorrect'));
                        }
                    }
                ],
                'newPassword'    => 'required',
                'repeatPassword' => 'required|same:newPassword'
            ],
            [
                'oldPassword.required'=>'Enter your current password',
                'newPassword.required'=> 'Enter new password',
                'repeatPassword.required'=>'Re enter your new password',
                'repeatPassword.same'=>'New Password and Confirm new password must match'
            ]);

        if (!$validator->passes()) {
            return response()->json(['status' => 0, 'error' => $validator->errors()->toArray()]);
        } else {
            $query = User::find(Auth::user()->id)->update(['password'=>Hash::make($request->newPassword)]);
            if (!$query) {
                return response()->json(['status' => 0, 'msg' => 'Something went wrong']);
            } else {
                return response()->json(['status' => 1, 'msg' => 'Password Updated successfull']);
            }
        }
    }
}
