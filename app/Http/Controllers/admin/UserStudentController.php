<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Student;
use Illuminate\Http\Request;

class UserStudentController extends Controller
{
    public function index()
    {
        if (request()->get('student_status')) {
            $students = Student::where('student_status', request()->get('student_status'))->whereHas('user', function ($q) {
                $q->where('status', 'Student');
            })->get();
            return view('dashboard.admin.user_students.index', [
                'sidebar' => 'user-students',
                'sub_sidebar' => 'students' . request()->get('student_status'),
                'students' => $students
            ]);
        }
    }
}
