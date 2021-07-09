<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Models\Programme;
use Illuminate\Http\Request;

class ProgrammeController extends Controller
{
    public function selectProgramme($id){
       $programme = Programme::where('dept_id',$id)->get();
       return $programme;
    }
}
