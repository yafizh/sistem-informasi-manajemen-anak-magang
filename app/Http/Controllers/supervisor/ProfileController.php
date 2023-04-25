<?php

namespace App\Http\Controllers\supervisor;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Models\User;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;

class ProfileController extends Controller
{
    public function profile()
    {
        return view('dashboard.supervisor.settings.profile', [
            'employee' => Auth::user()->employee,
            'sidebar' => ''
        ]);
    }

    public function updateProfile(Request $request)
    {
        $employee = Auth::user()->employee;

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

        return back()->with('success', 'Berhasil Perbaharui Profil!');
    }

    public function editPassword()
    {
        return view('dashboard.supervisor.settings.change_password', [
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
