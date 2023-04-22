<?php

use App\Http\Controllers\admin\EmployeeController as AdminEmployeeController;
use App\Http\Controllers\admin\AdminController as AdminAdminController;
use App\Http\Controllers\admin\SupervisorController as AdminSupervisorController;
use App\Http\Controllers\admin\InternshipApplicationController as AdminInternshipApplicationController;
use App\Http\Controllers\admin\StudentController as AdminStudentController;
use App\Http\Controllers\admin\UserStudentController as AdminUserStudentController;
use App\Http\Controllers\admin\InternshipProgramController as AdminInternshipProgramController;
use App\Http\Controllers\admin\InternshipStudentController as AdminInternshipStudentController;
use App\Http\Controllers\main\AuthController;
use App\Http\Controllers\main\InternshipApplicationController as MainInternshipApplicationController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('main.index');
});

Route::controller(AuthController::class)->group(function () {
    Route::get('/login', 'index');
    Route::post('/login', 'login');
    Route::get('/logout', 'logout');
});

Route::controller(MainInternshipApplicationController::class)->group(function () {
    Route::get('/internship-application-success', 'indexSuccess');
    Route::get('/internship-application', 'index');
    Route::post('/internship-application', 'store');
});

Route::get('/internship-application', function () {
    return view('main.internship_application');
});

Route::controller(ProfileController::class)->group(function () {
    Route::get('/change-password', 'changePassword');
    Route::put('/change-password', 'updatePassword');
});

Route::prefix('admin')->group(function () {
    Route::get('/', function () {
        return view('dashboard.admin.dashboard.index', [
            'sidebar' => 'dashboard'
        ]);
    });
    Route::resource('students', AdminStudentController::class);
    Route::resource('employees', AdminEmployeeController::class);
    Route::resource('admin', AdminAdminController::class);
    Route::resource('supervisor', AdminSupervisorController::class);
    Route::resource('user-students', AdminUserStudentController::class);

    Route::resource('internship-programs', AdminInternshipProgramController::class);
    Route::get('internship-programs/{internshipProgram}/supervisor', [AdminInternshipProgramController::class, 'supervisor']);

    Route::prefix('internship-application')->controller(AdminInternshipApplicationController::class)->group(function () {
        // Order Matters
        Route::get('/', 'index');
        Route::get('/rejected', 'rejected');
        Route::get('/approved', 'approved');
        Route::get('/{internshipApplication}', 'show');
        Route::delete('/{internshipApplication}', 'destroy');
        Route::put('/approve/{internshipApplication}', 'approve');
        Route::put('/reject/{internshipApplication}', 'reject');
    });

    Route::controller(AdminInternshipStudentController::class)->group(function () {
        Route::get('internship-students/{internshipProgram}', 'index');
        Route::get('internship-students/{internshipProgram}/create', 'create');
        Route::post('internship-students/{internshipProgram}', 'store');
        Route::delete('internship-students/{internshipProgram}/{student}', 'destroy');
    });
});

Route::prefix('supervisor')->group(function () {
    Route::get('/', function () {
        return view('dashboard.supervisor.dashboard.index');
    });
});

Route::prefix('student')->group(function () {
    Route::get('/', function () {
        return view('dashboard.student.dashboard.index');
    });
});
