<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Student;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class StudentController extends Controller
{
    public function index()
    {
        if (request()->get('student_status')) {
            return view('dashboard.admin.students.index', [
                'sidebar' => 'students' . request()->get('student_status'),
                'students' => Student::where('student_status', request()->get('student_status'))->orderBy('name')->get()
            ]);
        }

        return;
    }

    public function show(Student $student)
    {
        return view('dashboard.admin.students.show', [
            'sidebar' => 'students',
            'student' => $student
        ]);
    }

    public function edit(Student $student)
    {
        return view('dashboard.admin.students.edit', [
            'sidebar' => 'students',
            'student' => $student
        ]);
    }

    public function update(Request $request, Student $student)
    {
        $validatedData = $request->validate([
            'id_number' =>  [
                'required',
                Rule::unique('students', 'id_number')->ignore($student->id),
                Rule::unique('users', 'username')->ignore($student->user->id),
            ],
            'name' => 'required',
            'phone_number' => [
                Rule::unique('students', 'phone_number')->ignore($student->id),
            ],
            'email' => [
                'required',
                Rule::unique('students', 'email')->ignore($student->id),
            ],
            'sex' => '',
            'institution' => 'required',
            'student_status' => 'required',
            'birth_date' => '',
            'birth_place' => '',
        ], [
            'id_number.unique' => 'NIP ' . $request->id_number . ' telah terdaftar.',
            'phone_number.unique' => 'Nomor telepon ' . $request->phone_number . ' telah terdaftar.',
            'email.unique' => 'Email ' . $request->email . ' telah terdaftar.',
        ]);

        if ($request->file('photo'))
            $validatedData['photo'] = $request->file('photo')->store('students');

        User::where('id', $student->user->id)->update([
            'username' => $validatedData['id_number'],
        ]);

        Student::where('id', $student->id)->update($validatedData);

        return redirect('/admin/students?student_status=' . $validatedData['student_status']);
    }

    public function destroy(Student $student)
    {
        User::destroy($student->user->id);
        Student::destroy($student->id);
        return redirect('/admin/students?student_status=' . $student->student_status);
    }
}
