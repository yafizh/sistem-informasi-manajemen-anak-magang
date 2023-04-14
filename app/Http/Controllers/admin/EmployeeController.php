<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class EmployeeController extends Controller
{
    public function index()
    {
        return view('dashboard.admin.employees.index', [
            'employees' => Employee::orderBy('name')->get()
        ]);
    }

    public function create()
    {
        return view('dashboard.admin.employees.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'id_number' => 'required|unique:employees,id_number|unique:users,username',
            'name' => 'required',
            'phone_number' => 'required|unique:employees,phone_number',
            'email' => 'required|unique:employees,email',
            'sex' => 'required',
            'birth_place' => 'required',
            'birth_date' => 'required',
            'photo' => 'required',
        ], [
            'id_number.unique' => 'NIP ' . $request->id_number . ' telah terdaftar.',
            'phone_number.unique' => 'Nomor telepon ' . $request->phone_number . ' telah terdaftar.',
            'email.unique' => 'Email ' . $request->email . ' telah terdaftar.',
        ]);

        if ($request->file('photo'))
            $validatedData['photo'] = $request->file('photo')->store('employees');

        $validatedData['user_id'] = User::create([
            'username' => $validatedData['id_number'],
            'password' => bcrypt($validatedData['id_number']),
            'status' => 'Employee'
        ])->id;

        Employee::create($validatedData);

        return redirect('/admin/employees');
    }

    public function show(Employee $employee)
    {
        return view('dashboard.admin.employees.show', [
            'employee' => $employee
        ]);
    }

    public function edit(Employee $employee)
    {
        return view('dashboard.admin.employees.edit', [
            'employee' => $employee
        ]);
    }

    public function update(Request $request, Employee $employee)
    {
        $validatedData = $request->validate([
            'id_number' =>  [
                'required',
                Rule::unique('employees', 'id_number')->ignore($employee->id),
                Rule::unique('users', 'username')->ignore($employee->user->id),
            ],
            'name' => 'required',
            'phone_number' => [
                'required',
                Rule::unique('employees', 'phone_number')->ignore($employee->id),
            ],
            'email' => [
                'required',
                Rule::unique('employees', 'email')->ignore($employee->id),
            ],
            'sex' => 'required',
            'birth_place' => 'required',
            'birth_date' => 'required',
        ], [
            'id_number.unique' => 'NIP ' . $request->id_number . ' telah terdaftar.',
            'phone_number.unique' => 'Nomor telepon ' . $request->phone_number . ' telah terdaftar.',
            'email.unique' => 'Email ' . $request->email . ' telah terdaftar.',
        ]);

        if ($request->file('photo'))
            $validatedData['photo'] = $request->file('photo')->store('employees');

        User::where('id', $employee->user->id)->update([
            'username' => $validatedData['id_number'],
        ]);

        Employee::where('id', $employee->id)->update($validatedData);

        return redirect('/admin/employees');
    }

    public function destroy(Employee $employee)
    {
        User::destroy($employee->user->id);
        Employee::destroy($employee->id);
        return redirect('/admin/employees');
    }
}
