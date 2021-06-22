<?php

namespace App\Http\Controllers;

use App\Models\Lecturer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Subject;
use App\Models\Department;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{   
    public function index(){
        $user = User::all();
        return view('admin.home',['users'=> $user]);
    }

    public function updateProfile(Request $req){
        $validator = Validator::make($req->all(),[
            'first_name'    => 'required',
            'middle_name'   => 'required',
            'last_name'     => 'required',
            'email'         => 'required|email',
            'phone_no'      => 'required',
            'dob'           => 'required',
            'gender'        => 'required'
        ]);
        if(!$validator->passes()){
            return response()->json(['status'=>0, 'error'=>$validator->errors()->toArray()]);
        }else{
            $query = User::find(Auth::user()->id)->update([
                'first_name'    => $req->first_name,
                'middle_name'   => $req->middle_name,
                'last_name'     => $req->last_name,
                'email'         => $req->email,
                'phone_no'      => $req->phone_no,
                'dob'           => $req->dob,
                'gender'        => $req->gender,

            ]);
            if(!$query){
                return response()->json(['status'=>0, 'msg'=>'Something went wrong']);
            }else{
                return response()->json(['status'=>1, 'msg'=>'Your pfofile info has been update']);
            }
        }
    }
    
}
