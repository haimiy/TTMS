<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Models\Block;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class BlockController extends Controller
{
    public function index(){
        $block = DB::select('SELECT * FROM blocks');
            return view('lecturers.master.block', ['blocks'=>$block]);
        }
    
        public function getAjaxBlocksInformation(){
            $Block = DB::select('SELECT * FROM blocks');
            return response()->json([
                "status"=>true,
                "Block"=>$Block,
            ]);
    
        }
        
        public function getAjaxBlockInformation($id){
            $block = DB::select('SELECT * FROM blocks WHERE id='.$id);
    
            return response()->json([
                "status"=>true,
                "block"=>$block[0],
            ]);
        }
        public function deleteAjaxBlockInformation($id): \Illuminate\Http\JsonResponse
        {
            $block = DB::delete('DELETE FROM blocks WHERE id='.$id);
            return response()->json(['status'=>true, 'message'=>'Block Deleted Successful!']);
        }
    
        public function editAjaxBlockInformation(Request $request, $id){
                $validator = Validator::make($request->all(),[
                    'block_name'    => 'required',
                    't_floor'    => 'required',
                    'room_count'    => 'required',
                ]);
                if(!$validator->passes()){
                    return response()->json(['status'=>0, 'error'=>$validator->errors()->toArray()]);
                }else{
                    $query = Block::where('id',$id)->update([
                    'block_name'=>$request->block_name,
                    't_floor'=>$request->t_floor,
                    'room_count'=>$request->room_count
                    ]);
                
                    if(!$query){
                        return response()->json(['status'=>false, 'message'=>'Something went wrong']);
                    }else{
                        return response()->json(['status'=>true, 'message'=>'Block info has been update successful']);
                    }
                }
        }
    
        public function addBlock(Request $req){
            $validator = Validator::make($req->all(),[
                'block_name'    => 'required',
                't_floor'    => 'required',
                'room_count'    => 'required',
            ]);
            if(!$validator->passes()){
                return response()->json(['status'=>0, 'error'=>$validator->errors()->toArray()]);
            }else{
                $query=Block::create($req->all());
                if(!$query){
                    return response()->json(['status'=>0, 'msg'=>'Something went wrong']);
                }else{
                    return response()->json(['status'=>1, 'msg'=>'You insert data successfull']);
                }
            }
        }
}
