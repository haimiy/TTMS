<?php

use App\Http\Controllers\LockScreen;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TimeTableController;
use App\Http\Controllers\ClassController;



/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
})->middleware('guest');
Route::get('timetable',[TimeTableController::class, 'timetable']);
Route::get('timetable/test',[TimeTableController::class, 'test']);

Auth::routes();
Auth::routes(['register' => false]);

// Authenticated User group
Route::middleware(['auth'])->group(function(){


    //Admin authorization group
    Route::prefix('admin')->middleware('admin')->group(function(){

        Route::get('class', function(){
            return view('admin.class');
        });
        Route::get('home',[UserController::class, 'index']);
        Route::get('profile', function(){
            return view('admin.profile');
        });
    });
    //Admin authorization group End

    //Lecturers authorization group
    Route::prefix("lecturer")->middleware('lecturer')->group(function(){
        Route::get('home', function(){
            return view('lecturers.home');
        });
        Route::get('profile', function(){
            return view('lecturer.profile');
        });
    });
      //Lecurers authorization group End

    Route::prefix('master')->middleware(['master'])->group(function () {
        Route::get('home', function(){
            return view('lecturers.master.home');
        });
        Route::get('profile', function(){
            return view('lecturers.master.profile');
        });
        Route::get('class',[ClassController::class, 'index']);

    });

    Route::get('coordinator/home', function(){
        return view('lecturers.coordinator.home');
    })->middleware('coordinator');

     //Students authorization group
    Route::middleware('student')->group(function(){
        Route::get('student/home', function(){
            return view('students.home');
        })->middleware('student');

    });
     //Studnets authorization group END

    Route::get('lock',[LockScreen::class, 'lock_screen']);

    Route::post('update_profile',[UserController::class, 'updateProfile'])->name('updateProfileUser');
    Route::get('/logout', [\App\Http\Controllers\Auth\LoginController::class, 'logout']);
});
