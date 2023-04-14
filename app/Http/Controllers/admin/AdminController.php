<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $employees = Employee::whereHas('user', function ($q) {
            $q->where('status', 'Admin');
        })->get();
        return view('dashboard.admin.admin.index', [
            'employees' => $employees
        ]);
    }

    public function create()
    {
        $employees = Employee::whereHas('user', function ($q) {
            $q->where('status', 'Employee');
        })->get();
        return view('dashboard.admin.admin.create', [
            'employees' => $employees
        ]);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'employee_id' => 'required',
        ]);

        $user_id = Employee::find($validatedData['employee_id'])->user->id;
        User::where('id', $user_id)->update(['status' => 'Admin']);

        return redirect('/admin/admin');
    }

    public function destroy(Employee $admin)
    {
        User::where('id', $admin->user->id)->update(['status' => 'Employee']);
        return redirect('/admin/admin');
    }
}
