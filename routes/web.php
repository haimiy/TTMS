<?php

use App\Http\Controllers\LockScreen;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TimeTableController;
use App\Http\Controllers\ClassController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\SlotController;
use App\Http\Controllers\LecturerController;

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
Route::get('timetable', [TimeTableController::class, 'timetable']);

Auth::routes();
Auth::routes(['register' => false]);

// Authenticated User group
Route::middleware(['auth'])->group(function () {


    //Admin authorization group
    Route::prefix('admin')->middleware('admin')->group(function () {

        Route::get('class', function () {
            return view('admin.class');
        });
        Route::get('home', [UserController::class, 'index']);
        Route::get('profile', function () {
            return view('admin.profile');
        });
    });
    //Admin authorization group End

    //Lecturers authorization group
    Route::prefix("lecturer")->middleware('lecturer')->group(function () {
        Route::get('home', function () {
            return view('lecturers.home');
        });
    });
    //Lecurers authorization group End

    Route::prefix('master')->middleware(['master'])->group(function () {
        Route::get('home', [HomeController::class, 'index']);
        Route::get('profile/{id}',[LecturerController::class, 'showLecturerProfile']);
        //Class
        Route::post('class/import', [ClassController::class, 'import']);
        Route::get('class/export', [ClassController::class, 'export']);
        Route::get('class', [ClassController::class, 'index']);
        Route::post('class/create', [ClassController::class, 'addClass'])->name('add_class');
        Route::get('ajax/classes', [ClassController::class, 'getAjaxClassesInformation']);
        Route::get('ajax/classes/{id}', [ClassController::class, 'getAjaxClassInformation']);
        Route::delete('class/delete/{id}', [ClassController::class, 'deleteAjaxClassesInformation']);
        Route::post('classes/edit/{id}', [ClassController::class, 'editAjaxClassesInformation']);
        //End Class

        //subject
        Route::post('subject/import', [SubjectController::class, 'import']);
        Route::get('subject/export', [SubjectController::class, 'export']);
        Route::get('subject', [SubjectController::class, 'index']);
        Route::post('subject/create', [SubjectController::class, 'addSubject'])->name('add_subject');
        Route::get('ajax/subject', [SubjectController::class, 'getAjaxsubjectsInformation']);
        Route::get('ajax/subject/{id}', [SubjectController::class, 'getAjaxSubjectInformation']);
        Route::delete('subject/delete/{id}', [SubjectController::class, 'deleteAjaxsubjectInformation']);
        Route::post('subject/edit/{id}', [SubjectController::class, 'editAjaxSubjectInformation']);
        //End subject

        //Room
        Route::post('room/import', [RoomController::class, 'import']);
        Route::get('room/export', [RoomController::class, 'export']);
        Route::get('room', [RoomController::class, 'index']);
        Route::post('room/create', [RoomController::class, 'addroom'])->name('add_room');
        Route::get('ajax/room', [RoomController::class, 'getAjaxRoomsInformation']);
        Route::get('ajax/room/{id}', [RoomController::class, 'getAjaxRoomInformation']);
        Route::delete('room/delete/{id}', [RoomController::class, 'deleteAjaxRoomInformation']);
        Route::post('room/edit/{id}', [RoomController::class, 'editAjaxRoomInformation']);
        //End Room

        //Slot
        Route::post('slot/import', [SlotController::class, 'import']);
        Route::get('slot/export', [SlotController::class, 'export']);
        Route::get('slot', [SlotController::class, 'index']);
        Route::post('slot/create', [SlotController::class, 'addSlot'])->name('add_slot');
        Route::get('ajax/slot', [SlotController::class, 'getAjaxSlotsInformation']);
        Route::get('ajax/slot/{id}', [SlotController::class, 'getAjaxSlotInformation']);
        Route::delete('slot/delete/{id}', [SlotController::class, 'deleteAjaxSlotInformation']);
        Route::post('slot/edit/{id}', [SlotController::class, 'editAjaxSlotInformation']);
        //End Slot

        //Manage Lecturer
        Route::post('profile/update/{id}', [LecturerController::class, 'updateUserProfile']);
        Route::get('lecturer', [LecturerController::class, 'create']);
        Route::post('lecturer/create', [LecturerController::class, 'addLecturer'])->name('add_lecturer');
        Route::get('ajax/lecturer', [LecturerController::class, 'getAjaxLecturersInformation']);
        Route::get('ajax/lecturer/{id}', [LecturerController::class, 'getAjaxLecturerInformation']);
        Route::delete('lecturer/delete/{id}', [LecturerController::class, 'deleteAjaxLecturerInformation']);
        Route::post('lecturer/edit/{id}', [LecturerController::class, 'editAjaxLecturerInformation']);
        Route::post('/change-psw', [LecturerController::class, 'changePassword']);
        //End Manage Lecturer

        //Manage Timetable
        Route::get('timetable', [TimeTableController::class, 'index']);
        Route::get('timetable/class', [TimeTableController::class, 'showClassTimetable']);

    });

    Route::get('coordinator/home', function () {
        return view('lecturers.coordinator.home');
    })->middleware('coordinator');

    //Students authorization group
    Route::middleware('student')->group(function () {
        Route::get('student/home', function () {
            return view('students.home');
        })->middleware('student');
    });
    //Studnets authorization group END

    Route::get('lock', [LockScreen::class, 'lock_screen']);

    Route::post('update_profile', [UserController::class, 'updateProfile'])->name('updateProfileUser');
    Route::get('/logout', [\App\Http\Controllers\Auth\LoginController::class, 'logout']);
});
