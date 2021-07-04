<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Room;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\RoomsImport;
use App\Exports\RoomsExport;

class RoomController extends Controller
{
    public function index(){
        $room = Room::all();
        return view('lecturers.master.room', ['rooms'=>$room]);

    }

    public function getAjaxRoomsInformation(){
        $Rooms = Room::all();
        return response()->json([
            "status"=>true,
            "Rooms"=>$Rooms,
        ]);

    }
    
    public function getAjaxRoomInformation($id){
        $room = Room::find($id);

        return response()->json([
            "status"=>true,
            "room"=>$room,
        ]);
    }
    public function deleteAjaxRoomInformation($id): \Illuminate\Http\JsonResponse
    {
        $room = Room::find($id);
        $room->delete();
        return response()->json(['status'=>true, 'message'=>'Room Deleted Successful!']);
    }

    public function editAjaxRoomInformation(Request $request, $id){
            $validator = Validator::make($request->all(),[
                'room_name'    => 'required',
                'room_capacity'    => 'required',
            ]);
            if(!$validator->passes()){
                return response()->json(['status'=>0, 'error'=>$validator->errors()->toArray()]);
            }else{
                $query = room::where('id',$id)->update([
                    'room_name'    => $request->room_name,
                    'room_capacity'   => $request->room_capacity,
                ]);
                if(!$query){
                    return response()->json(['status'=>false, 'message'=>'Something went wrong']);
                }else{
                    return response()->json(['status'=>true, 'message'=>'subject info has been update successful']);
                }
            }
    }

    public function addRoom(Request $req){
        $validator = Validator::make($req->all(),[
            'room_name'    => 'required',
            'room_capacity'    => 'required',
        ]);
        if(!$validator->passes()){
            return response()->json(['status'=>0, 'error'=>$validator->errors()->toArray()]);
        }else{
            $query=Room::create($req->all());
            if(!$query){
                return response()->json(['status'=>0, 'msg'=>'Something went wrong']);
            }else{
                return response()->json(['status'=>1, 'msg'=>'You insert data successfull']);
            }
        }
    }
    public function import(Request $request) 
    {
        Excel::import(new RoomsImport, $request->file('file')->store('temp'));
        return back();
    }
    public function export() 
    {
        return Excel::download(new RoomsExport, 'rooms.xlsx');
    }
}
