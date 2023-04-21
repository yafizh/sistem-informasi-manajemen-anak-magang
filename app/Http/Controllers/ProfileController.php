<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class ProfileController extends Controller
{
    public function changePassword()
    {
        return view('dashboard.admin.settings.change_password', [
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

        $user_id = request()->get('user_id') ?? auth()->user()->id;

        User::where('id', $user_id)->update([
            'password' => bcrypt($validatedData['new_password']),
        ]);

        return back()->with('success', 'Berhasil Ganti Password!');
    }
}
