<?php

use App\Http\Controllers\admin\EmployeeController as AdminEmployeeController;
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
Route::get('/login', function () {
    return view('main.login');
});
Route::get('/internship-application', function () {
    return view('main.internship_application');
});

Route::prefix('admin')->group(function ()
{
    Route::get('/', function () {
        return view('dashboard.admin.dashboard.index');
    });
    Route::resource('employees', AdminEmployeeController::class);
});

Route::prefix('supervisor')->group(function ()
{
    Route::get('/', function () {
        // return view('dashboard.admin.dashboard.index');
    });
});

Route::prefix('student')->group(function ()
{
    Route::get('/', function () {
        // return view('dashboard.admin.dashboard.index');
    });
});