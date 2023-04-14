<?php

use App\Http\Controllers\admin\EmployeeController as AdminEmployeeController;
use App\Http\Controllers\admin\AdminController as AdminAdminController;
use App\Http\Controllers\admin\SupervisorController as AdminSupervisorController;
use App\Http\Controllers\main\AuthController;
use App\Http\Controllers\main\InternshipApplicationController as MainInternshipApplicationController;
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

Route::controller(MainInternshipApplicationController::class)->group(function ()
{
    Route::get('/internship-application', 'index');
    Route::post('/internship-application', 'store');
});

Route::get('/internship-application', function () {
    return view('main.internship_application');
});

Route::prefix('admin')->group(function () {
    Route::get('/', function () {
        return view('dashboard.admin.dashboard.index');
    });
    Route::resource('employees', AdminEmployeeController::class);
    Route::resource('admin', AdminAdminController::class);
    Route::resource('supervisor', AdminSupervisorController::class);
});

Route::prefix('supervisor')->group(function () {
    Route::get('/', function () {
        // return view('dashboard.admin.dashboard.index');
    });
});

Route::prefix('student')->group(function () {
    Route::get('/', function () {
        // return view('dashboard.admin.dashboard.index');
    });
});
