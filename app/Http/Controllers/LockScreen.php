<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LockScreen extends Controller
{
    public function lock_screen(){
        return view('lock_screen');
    }
}
