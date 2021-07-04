<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Slot;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\SlotsImport;
use App\Exports\SlotsExport;

class SlotController extends Controller
{
    public function index(){
        $slot = Slot::all();
        return view('lecturers.master.slot', ['slots'=>$slot]);

    }

    public function getAjaxSlotsInformation(){
        $Slots = Slot::all();
        return response()->json([
            "status"=>true,
            "Slots"=>$Slots,
        ]);

    }
    
    public function getAjaxSlotInformation($id){
        $slot = Slot::find($id);

        return response()->json([
            "status"=>true,
            "slot"=>$slot,
        ]);
    }
    public function deleteAjaxSlotInformation($id): \Illuminate\Http\JsonResponse
    {
        $slot = Slot::find($id);
        $slot->delete();
        return response()->json(['status'=>true, 'message'=>'Slot Deleted Successful!']);
    }

    public function editAjaxSlotInformation(Request $request, $id){
            $validator = Validator::make($request->all(),[
                'start_time'    => 'required',
                'end_time'    => 'required',
            ]);
            if(!$validator->passes()){
                return response()->json(['status'=>0, 'error'=>$validator->errors()->toArray()]);
            }else{
                $query = Slot::where('id',$id)->update([
                    'start_time'    => $request->start_time,
                    'end_time'   => $request->end_time,
                ]);
                if(!$query){
                    return response()->json(['status'=>false, 'message'=>'Something went wrong']);
                }else{
                    return response()->json(['status'=>true, 'message'=>'subject info has been update successful']);
                }
            }
    }

    public function addSlot(Request $req){
        $validator = Validator::make($req->all(),[
            'start_time'    => 'required',
            'end_time'    => 'required',
        ]);
        if(!$validator->passes()){
            return response()->json(['status'=>0, 'error'=>$validator->errors()->toArray()]);
        }else{
            $query=Slot::create($req->all());
            if(!$query){
                return response()->json(['status'=>0, 'msg'=>'Something went wrong']);
            }else{
                return response()->json(['status'=>1, 'msg'=>'You insert data successfull']);
            }
        }
    }
    public function import(Request $request) 
    {
        Excel::import(new SlotsImport, $request->file('file')->store('temp'));
        return back();
    }
    public function export() 
    {
        return Excel::download(new SlotsExport, 'slots.xlsx');
    }
}
