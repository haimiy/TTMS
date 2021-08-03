<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Master\TimeTableController;
use App\Http\Controllers\Master\ClassController;
use App\Http\Controllers\Master\SubjectController;
use App\Http\Controllers\Master\HomeController;
use App\Http\Controllers\Coordinator\HomeController as CoordinatorHome;
use App\Http\Controllers\Lecturer\HomeController as LecturerHome;
use App\Http\Controllers\Student\HomeController as StudentHome;
use App\Http\Controllers\Coordinator\SubjectController as CoordinatorSubject;
use App\Http\Controllers\Coordinator\LecturerController as CoordinatorLecturer;
use App\Http\Controllers\Lecturer\LecturerController as LecturerLecturer;
use App\Http\Controllers\Coordinator\ClassController as CoordinatorClass;
use App\Http\Controllers\Master\RoomController;
use App\Http\Controllers\Master\SlotController;
use App\Http\Controllers\Master\BlockController;
use App\Http\Controllers\Master\ReportController;
use App\Http\Controllers\Master\ProgrammeController;
use App\Http\Controllers\Master\LecturerController;
use App\Http\Controllers\Student\StudentProfileController;
use PhpOffice\PhpSpreadsheet\Shared\OLE\PPS\Root;

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
Route::get('timetable/download', [TimeTableController::class, 'downloadTimetable']);

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

    Route::prefix('master')->as('.master')->middleware(['master'])->group(function () {
        Route::get('home', [HomeController::class, 'index']);
        Route::get('report', [ReportController::class, 'index']);
        //Notify
        Route::get('notify', [HomeController::class, 'notify']);
        Route::post('notify/send/message', [HomeController::class, 'sendMessage']);
        //End Notify
        //Class
        Route::post('class/import', [ClassController::class, 'import']);
        Route::post('class/add_module', [ClassController::class, 'addModules']);
        Route::post('class/delete_module', [ClassController::class, 'deleteModules']);
        Route::get('class/export', [ClassController::class, 'export']);
        Route::get('class', [ClassController::class, 'index']);
        Route::post('class/create', [ClassController::class, 'addClass']);
        Route::get('ajax/classes', [ClassController::class, 'getAjaxClassesInformation']);
        Route::get('ajax/classes/{id}', [ClassController::class, 'getAjaxClassInformation']);
        Route::delete('class/delete/{id}', [ClassController::class, 'deleteAjaxClassesInformation']);
        Route::post('classes/edit/{id}', [ClassController::class, 'editAjaxClassesInformation']);
        Route::get('classes/classSubject/{id}', [ClassController::class, 'selectClassesSubject']);

        //get module based on specific departments
        Route::get('subject/select/{id}', [ClassController::class, 'selectDepartmentSubject']);
        Route::get('level/select/{id}', [ClassController::class, 'selectLevel']);

        //get subject base on class code
        Route::get('class/{class_code}/subjects', [ClassController::class, 'getAjaxClassesCodeSubjects']);
        Route::post('/classes/classSubject', [ClassController::class, 'deleteAjaxClassesCodeSubject']);
        //End Classes

        //Programme
        Route::get('programme/select/{id}', [ProgrammeController::class, 'selectProgramme']);
        //End Programme

        //subject
        Route::post('subject/import', [SubjectController::class, 'import']);
        Route::get('subject/export', [SubjectController::class, 'export']);
        Route::get('subject', [SubjectController::class, 'index']);
        Route::post('subject/create', [SubjectController::class, 'addSubject']);
        Route::get('ajax/subject', [SubjectController::class, 'getAjaxsubjectsInformation']);
        Route::get('ajax/subject/{id}', [SubjectController::class, 'getAjaxSubjectInformation']);
        Route::delete('subject/delete/{id}', [SubjectController::class, 'deleteAjaxsubjectInformation']);
        Route::post('subject/edit/{id}', [SubjectController::class, 'editAjaxSubjectInformation']);
        //End subject
        //Room
        Route::post('room/import', [RoomController::class, 'import']);
        Route::get('room/export', [RoomController::class, 'export']);
        Route::get('room', [RoomController::class, 'index']);
        Route::post('room/create', [RoomController::class, 'addRoom']);
        Route::get('ajax/room', [RoomController::class, 'getAjaxRoomsInformation']);
        Route::get('ajax/room/{id}', [RoomController::class, 'getAjaxRoomInformation']);
        Route::delete('room/delete/{id}', [RoomController::class, 'deleteAjaxRoomInformation']);
        Route::post('room/edit/{id}', [RoomController::class, 'editAjaxRoomInformation']);
        //End Room

        //Block
        Route::get('block', [BlockController::class, 'index']);
        Route::post('block/import', [BlockController::class, 'import']);
        Route::get('block/export', [BlockController::class, 'export']);
        Route::get('block', [BlockController::class, 'index']);
        Route::post('block/create', [BlockController::class, 'addBlock']);
        Route::get('ajax/block', [BlockController::class, 'getAjaxBlocksInformation']);
        Route::get('ajax/block/{id}', [BlockController::class, 'getAjaxBlockInformation']);
        Route::delete('block/delete/{id}', [BlockController::class, 'deleteAjaxBlockInformation']);
        Route::post('block/edit/{id}', [BlockController::class, 'editAjaxBlockInformation']);
        //End Block

        //Slot
        Route::post('slot/import', [SlotController::class, 'import']);
        Route::get('slot/export', [SlotController::class, 'export']);
        Route::get('slot', [SlotController::class, 'index']);
        Route::post('slot/create', [SlotController::class, 'addSlot']);
        Route::get('ajax/slot', [SlotController::class, 'getAjaxSlotsInformation']);
        Route::get('ajax/slot/{id}', [SlotController::class, 'getAjaxSlotInformation']);
        Route::delete('slot/delete/{id}', [SlotController::class, 'deleteAjaxSlotInformation']);
        Route::post('slot/edit/{id}', [SlotController::class, 'editAjaxSlotInformation']);
        //End Slot
        //Manage Lecturer
        Route::get('profile/{id}', [LecturerController::class, 'showLecturerProfile']);
        Route::post('profile/update/{id}', [LecturerController::class, 'updateUserProfile']);
        Route::get('lecturer', [LecturerController::class, 'create']);
        Route::post('lecturer/add_lecturer_subject', [LecturerController::class, 'addLecturerSubject']);
        Route::post('lecturer/create', [LecturerController::class, 'addLecturer']);
        Route::get('ajax/lecturer', [LecturerController::class, 'getAjaxLecturersInformation']);
        Route::get('ajax/lecturer/{id}', [LecturerController::class, 'getAjaxLecturerInformation']);
        Route::delete('lecturer/delete/{id}', [LecturerController::class, 'deleteAjaxLecturerInformation']);
        Route::post('lecturer/edit/{id}', [LecturerController::class, 'editAjaxLecturerInformation']);
        Route::post('/change-psw', [LecturerController::class, 'changePassword']);
        //End Manage Lecturer
        //Manage Timetable
        Route::get('timetable', [TimeTableController::class, 'index']);
        Route::get('timetable', [TimeTableController::class, 'index']);
        Route::get('timetable/class', [TimeTableController::class, 'showClassTimetable']);
    });

    //COORDINTATOR
    Route::prefix('coordinator')->as('.coordinator')->middleware(['coordinator'])->group(function () {
        Route::get('home', [CoordinatorHome::class, 'index']);
        //Notify
        Route::get('notify', [CoordinatorHome::class, 'notify']);
        Route::post('notify/send/message', [CoordinatorHome::class, 'sendMessage']);
        //End Notify
        //subject
        Route::post('subject/import', [CoordinatorSubject::class, 'import']);
        Route::get('subject/export', [CoordinatorSubject::class, 'export']);
        Route::get('subject', [CoordinatorSubject::class, 'index']);
        Route::post('subject/create', [CoordinatorSubject::class, 'addSubject']);
        Route::get('ajax/subject', [CoordinatorSubject::class, 'getAjaxsubjectsInformation']);
        Route::get('ajax/subject/{id}', [CoordinatorSubject::class, 'getAjaxSubjectInformation']);
        Route::delete('subject/delete/{id}', [CoordinatorSubject::class, 'deleteAjaxsubjectInformation']);
        Route::post('subject/edit/{id}', [CoordinatorSubject::class, 'editAjaxSubjectInformation']);
        //End subject
        //Class
        Route::post('class/import', [CoordinatorClass::class, 'import']);
        Route::get('class/export', [CoordinatorClass::class, 'export']);
        Route::get('class', [CoordinatorClass::class, 'index']);
        Route::post('class/create', [CoordinatorClass::class, 'addClass']);
        Route::get('ajax/classes', [CoordinatorClass::class, 'getAjaxClassesInformation']);
        Route::get('ajax/classes/{id}', [CoordinatorClass::class, 'getAjaxClassInformation']);
        Route::delete('class/delete/{id}', [CoordinatorClass::class, 'deleteAjaxClassesInformation']);
        Route::post('classes/edit/{id}', [CoordinatorClass::class, 'editAjaxClassesInformation']);
        //End Class
        //Manage Lecturer
        Route::post('addSubject', [CoordinatorLecturer::class, 'addSubjectToLecturer']);
        Route::get('profile/{id}', [CoordinatorLecturer::class, 'showLecturerProfile']);
        Route::post('profile/update/{id}', [CoordinatorLecturer::class, 'updateUserProfile']);
        Route::get('lecturer', [CoordinatorLecturer::class, 'create']);
        Route::post('lecturer/create', [CoordinatorLecturer::class, 'addLecturer'])->name('add_lecturer');
        Route::get('ajax/lecturer', [CoordinatorLecturer::class, 'getAjaxLecturersInformation']);
        Route::get('ajax/lecturer/{id}', [CoordinatorLecturer::class, 'getAjaxLecturerInformation']);
        Route::delete('lecturer/delete/{id}', [CoordinatorLecturer::class, 'deleteAjaxLecturerInformation']);
        Route::post('lecturer/edit/{id}', [CoordinatorLecturer::class, 'editAjaxLecturerInformation']);
        Route::post('/change-psw', [CoordinatorLecturer::class, 'changePassword']);
        //End Manage Lecturer
    });

    //Students authorization group
    Route::prefix('student')->middleware('student')->group(function () {
        Route::get('home', [StudentHome::class, 'index']);
        Route::get('profile/{id}', [StudentProfileController::class, 'showStudentProfile']);
        Route::post('profile/update/{id}', [StudentProfileController::class, 'updateUserProfile']);
        Route::post('/change-psw', [CoordinatorLecturer::class, 'changePassword']);
        Route::get('read_message', [StudentHome::class, 'readMessage']);
    });
    //Studnets authorization group END

    //Lecturers authorization group
    Route::prefix("lecturer")->middleware('lecturer')->group(function () {
        Route::get('home', [LecturerHome::class, 'index']);
        Route::get('notify', [LecturerHome::class, 'notify']);
        Route::post('notify/send/message', [LecturerHome::class, 'sendMessage']);
        Route::get('profile/{id}', [LecturerLecturer::class, 'showLecturerProfile']);
        Route::post('profile/update/{id}', [LecturerLecturer::class, 'updateUserProfile']);
        Route::post('/change-psw', [LecturerLecturer::class, 'changePassword']);
    });

    //Lecurers authorization group End

    Route::post('update_profile', [UserController::class, 'updateProfile'])->name('updateProfileUser');
    Route::get('/logout', [\App\Http\Controllers\Auth\LoginController::class, 'logout']);
});
