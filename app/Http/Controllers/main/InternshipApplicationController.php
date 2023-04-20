<?php

namespace App\Http\Controllers\main;

use App\Http\Controllers\Controller;
use App\Models\InternshipApplication;
use App\Models\Student;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class InternshipApplicationController extends Controller
{
    public function index()
    {
        return view('main.internship_application');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'id_number' => 'required',
            'name' => 'required',
            'email' => 'required|unique:employees,email',
            'institution' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
            'student_status' => 'required',
        ]);

        $validatedData['application_date'] = Carbon::now();
        $validatedData['internship_application_id'] = InternshipApplication::create($validatedData)->id;
        $validatedData['user_id'] = User::create([
            'username' => $validatedData['id_number'],
            'password' => bcrypt($validatedData['id_number']),
            'status' => 'Student'
        ])->id;
        Student::create($validatedData);

        return redirect('/internship-application-success');
    }

    public function indexSuccess()
    {
        return view('main.internship_application_success');
    }
}
