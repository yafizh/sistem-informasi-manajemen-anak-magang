<?php

namespace App\Http\Controllers\supervisor;

use App\Http\Controllers\Controller;
use App\Models\InternshipProgram;

class StudentController extends Controller
{
    public function index(InternshipProgram $internshipProgram)
    {
        return view('dashboard.supervisor.students.index', [
            'internship_program' => $internshipProgram,
            'sidebar' => 'internship-programs-' . request()->get('student_status'),
        ]);
    }
}
