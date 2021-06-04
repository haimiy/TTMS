<?php

use App\Http\Controllers\LockScreen;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

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
Auth::routes();
Auth::routes(['register' => false]);

// Authenticated User group
Route::middleware(['auth'])->group(function(){

    
    //Admin authorization group
    Route::middleware('admin')->group(function(){

        Route::get('admin/class', function(){
            return view('admin.class');
        });
        Route::get('admin/home',[UserController::class, 'index']);
    });
    //Admin authorization group End

    
    Route::middleware('auth')->group(function(){
        Route::get('lecturer/home', function(){
            return view('lecturers.home');
        })->middleware('lecturer');
        Route::get('lecturer/master/home', function(){
            return view('lecturers.master.home');
        })->middleware('master');
    });

    Route::middleware('auth')->group(function(){
        Route::get('student/home', function(){
            return view('students.home');
        })->middleware('student');

    });

    Route::get('profile', function(){
        return view('profile');
    });
    Route::get('lock',[LockScreen::class, 'lock_screen']);
   
    Route::post('update_profile',[UserController::class, 'updateProfile'])->name('updateProfileUser');
    Route::get('/logout', [\App\Http\Controllers\Auth\LoginController::class, 'logout']);
});