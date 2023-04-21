<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Models\User;
use Illuminate\Http\Request;

class SupervisorController extends Controller
{
    public function index()
    {
        $employees = Employee::whereHas('user', function ($q) {
            $q->where('status', 'Supervisor');
        })->get();
        return view('dashboard.admin.supervisor.index', [
            'sidebar' => 'user-employees',
            'sub_sidebar' => 'supervisor',
            'employees' => $employees
        ]);
    }

    public function create()
    {
        $employees = Employee::whereHas('user', function ($q) {
            $q->where('status', 'Employee');
        })->get();
        return view('dashboard.admin.supervisor.create', [
            'sidebar' => 'user-employees',
            'sub_sidebar' => 'supervisor',
            'employees' => $employees
        ]);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'employee_id' => 'required',
        ]);

        $user_id = Employee::find($validatedData['employee_id'])->user->id;
        User::where('id', $user_id)->update(['status' => 'Supervisor']);

        return redirect('/admin/supervisor');
    }

    public function destroy(Employee $supervisor)
    {
        User::where('id', $supervisor->user->id)->update(['status' => 'Employee']);
        return redirect('/admin/supervisor');
    }
}
