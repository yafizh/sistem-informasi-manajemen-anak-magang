<?php

namespace App\Http\Controllers\student;

use App\Http\Controllers\Controller;
use App\Models\Student;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;

class ProfileController extends Controller
{
    public function profile()
    {
        return view('dashboard.student.settings.profile', [
            'student' => Auth::user()->student,
            'sidebar' => ''
        ]);
    }

    public function updateProfile(Request $request)
    {
        $student = Auth::user()->student;

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

        return back()->with('success', 'Berhasil Perbaharui Profil!');
    }

    public function editPassword()
    {
        return view('dashboard.student.settings.change_password', [
            'sidebar' => ''
        ]);
    }

    public function updatePassword(Request $request)
    {
        $validatedData = $request->validate([
            'new_password' => 'required',
            'confirm_new_password' => 'required',
        ]);

        if ($validatedData['new_password'] !== $validatedData['confirm_new_password']) {
            throw ValidationException::withMessages(['new_password' => 'Password Baru Tidak Sama']);
        }

        User::where('id', Auth::user()->id)->update([
            'password' => bcrypt($validatedData['new_password']),
        ]);

        return back()->with('success', 'Berhasil Ganti Password!');
    }
}
