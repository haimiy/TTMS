<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Models\Programme;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class ProgrammeController extends Controller
{
    public function selectProgramme($id){
       $programmes = Programme::where('dept_id',$id)->get();
       return response()->json([
           'programmes'=>$programmes
       ]);
    }
}
