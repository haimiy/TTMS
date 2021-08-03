<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Models\Classes;
use Illuminate\Http\Request;
use App\Models\Lecturer;
use App\Models\LecturerRole;
use App\Models\LecturerSubject;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Department;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class LecturerController extends Controller
{
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

    public function create()
    {
        $dept = Department::all();
        $user = User::all();
        $lecturerRoles = LecturerRole::all();
        $lecturer =  DB::table('lecturers')
            ->join('departments', 'departments.id', '=', 'lecturers.dept_id')
            ->join('users', 'users.id', '=', 'lecturers.user_id')
            ->select('lecturers.*', 'dept_name', 'login_id')
            ->get();
        return view('lecturers.master.lecturer', [
            'lecturers' => $lecturer,
            'depts' => $dept,
            'users' => $user,
            'lecturerRoles' => $lecturerRoles
        ]);

        // $lecturer = DB::select('SELECT l.id,u.login_id, s.subject_name FROM lecturers l LEFT JOIN users u ON u.id=l.user_id LEFT JOIN lecturer_subjecs ls ON l.id = ls.lecturer_id LEFT JOIN subjects s ON s.id =ls.subject_id' );
        // return view('lecturers.master.lecturer', ['lecturers'=>$lecturer, 'subjects'=>$subject]);
    }

    public function showLecturerProfile($id)
    {
        $depts = Department::all();
        $lecturer = DB::select('SELECT l.id,l.user_id,u.*,d.* FROM lecturers l
        LEFT JOIN users u ON u.id=l.user_id
        LEFT JOIN lecturer_subjecs ls ON l.id = ls.lecturer_id
        LEFT JOIN departments d ON d.id=l.dept_id WHERE u.id=' . $id);

        $classes = DB::select('SELECT c.*,  d.dept_name FROM classes c
        left join lecturer_classes lc ON c.id = lc.class_id
        left join departments d ON d.id = c.dept_id
        WHERE lc.lecturer_id=' . $id);

        $subjects = DB::select('SELECT * FROM subjects s
        left join lecturer_subjecs ls ON s.id = ls.subject_id
        left join lecturers l on ls.lecturer_id  =  l.id
        left JOIN users u on l.user_id =u.id
        WHERE u.id=' . $id);
        return view('lecturers.master.lecturerProfile', [
            'lecturer' => $lecturer[0], 
            'subjects' => $subjects, 
            'classes' => $classes,
            'depts' => $depts
        ]);
    }

    public function getAjaxLecturersInformation()
    {
        $Lecturers = Lecturer::all();
        return response()->json([
            "status" => true,
            "Lecturers" => $Lecturers,
        ]);
    }

    public function getAjaxLecturerInformation($id)
    {
        $lecturer = Lecturer::find($id);

        return response()->json([
            "status" => true,
            "lecturer" => $lecturer,
        ]);
    }
    public function deleteAjaxLecturerInformation($id): \Illuminate\Http\JsonResponse
    {
        $lecturer = Lecturer::find($id);
        $lecturer->delete();
        return response()->json(['status' => true, 'message' => 'Lecturer Deleted Successful!']);
    }

    public function editAjaxLecturerInformation(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'login_id'    => 'required',
            'subject_id'    => 'required'
        ]);
        if (!$validator->passes()) {
            return response()->json(['status' => 0, 'error' => $validator->errors()->toArray()]);
        } else {
            $query = Lecturer::where('id', $id)->update([
                'login_id'    => $request->login_id,
                'subject_id'   => $request->subject_id,
            ]);
            if (!$query) {
                return response()->json(['status' => false, 'message' => 'Something went wrong']);
            } else {
                return response()->json(['status' => true, 'message' => 'Lecturer info has been update successful']);
            }
        }
    }

    public function addLecturer(Request $req)
    {
        $validator = Validator::make($req->all(), [
            'first_name'    => 'required',
            'middle_name'   => 'required',
            'last_name'     => 'required',
            'email'         => 'required|email',
            'phone_no'      => 'required',
            'dob'           => 'required',
            'gender'        => 'required',
            'dept_id' => 'required',
            'lecturer_role_id' => 'required',
        ]);
        if(!$validator->passes()){
            return response()->json(['status'=>0, 'error'=>$validator->errors()->toArray()]);
        }else{
            $req['role_id']=2;
            $req['password'] = Hash::make($req->password);

           $user = User::create($req->all());
           $req['user_id'] = $user->id;

            $lecturer = Lecturer::create($req->all());

            if(!$lecturer){
                return response()->json(['status'=>0, 'msg'=>'Something went wrong']);
            }else{
                return response()->json(['status'=>1, 'msg'=>'You insert data successfull']);
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
    public function addLecturerSubject(Request $request){
        $lecturer = Lecturer::where('user_id', $request->lecturer_id)->get();
        
        $request['lecturer_id'] = $lecturer[0]->id;
        $lecturer_subject = LecturerSubject::create($request->all());
        if (!$lecturer_subject) {
            return response()->json(['status' => 0, 'message' => 'Something went wrong']);
        } else {
            return response()->json(['status' => 1, 'message' => 'Subject Added successfull']);
        }
    }
}
