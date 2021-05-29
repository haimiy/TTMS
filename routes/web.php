<?php

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
});
Route::get('admin/class', function(){
    return view('admin.class');
});
Route::get('lecturer/home', function(){
    return view('lecturers.home');
});
Route::get('student/home', function(){
    return view('students.home');
});
Route::get('profile', function(){
    return view('profile');
});
Route::get('admin/home',[UserController::class, 'index']);
Route::post('update_profile',[UserController::class, 'updateProfile'])->name('updateProfileUser');
Auth::routes();
Auth::routes(['register' => false]);

Route::get('/logout', [\App\Http\Controllers\Auth\LoginController::class, 'logout']);

