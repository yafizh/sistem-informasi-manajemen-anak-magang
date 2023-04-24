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
use App\Http\Controllers\supervisor\InternshipProgramController as SupervisorInternshipProgramController;
use App\Http\Controllers\supervisor\StudentController as SupervisorStudentController;
use App\Http\Controllers\supervisor\StudentPresenceController as SupervisorStudentPresenceController;
use App\Http\Controllers\supervisor\StudentEvaluationController as SupervisorStudentEvaluationController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('main.index');
});

Route::controller(AuthController::class)->group(function () {
    Route::get('/login', 'index')->name('login');
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

Route::controller(ProfileController::class)->middleware('auth')->group(function () {
    Route::get('/change-password', 'changePassword');
    Route::put('/change-password', 'updatePassword');
});

Route::prefix('admin')->middleware('auth')->group(function () {
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

Route::prefix('supervisor')->middleware('auth')->group(function () {
    Route::get('/', function () {
        return view('dashboard.supervisor.dashboard.index', [
            'sidebar' => 'dashboard'
        ]);
    });

    Route::prefix('internship-programs')
        ->controller(SupervisorInternshipProgramController::class)
        ->group(function () {
            Route::get('/', 'index');
            Route::get('/{internshipProgram}', 'show');
        });

    Route::prefix('students')
        ->controller(SupervisorStudentController::class)
        ->group(function () {
            Route::get('/{internshipProgram}', 'index');
        });

    Route::prefix('students/{internshipProgram}')
        ->group(function () {
            Route::get('/presence-table', [SupervisorStudentPresenceController::class, 'table']);
            Route::resource('/presences', SupervisorStudentPresenceController::class)->parameters(['presences' => 'studentPresence']);
        });

    Route::prefix('students')
        ->controller(SupervisorStudentEvaluationController::class)
        ->group(function () {
            Route::get('/{internshipProgram}/evaluations', 'index');
            Route::get('/{internshipProgram}/evaluations/{internshipStudent}', 'create');
            Route::post('/{internshipProgram}/evaluations/{internshipStudent}', 'store');
        });
});

Route::prefix('student')->middleware('auth')->group(function () {
    Route::get('/', function () {
        return view('dashboard.student.dashboard.index');
    });
});
