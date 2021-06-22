<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $count_classes= DB::table('classes')->get()->count();
        $count_subjects = DB::table('subjects')->get()->count();
        $count_rooms = DB::table('rooms')->get()->count();
        $count_lecturers = DB::table('lecturers')->get()->count();
        return view('lecturers.master.home', compact('count_classes', 'count_subjects','count_rooms', 'count_lecturers'));
    }
}
