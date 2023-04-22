<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\InternshipProgram;
use App\Models\InternshipStudent;
use App\Models\Student;
use Illuminate\Http\Request;

class InternshipStudentController extends Controller
{
    public function index(InternshipProgram $internshipProgram)
    {
        return view('dashboard.admin.internship_students.index', [
            'internship_program' => $internshipProgram,
            'sidebar' => 'internship-programs',
            'sub_sidebar' => 'students' . request()->get('student_status'),
        ]);
    }

    public function create(InternshipProgram $internshipProgram)
    {
        if (request()->get('student_status')) {
            $students = Student::where('student_status', request()->get('student_status'))
                ->doesntHave('internshipStudent')
                ->get();

            return view('dashboard.admin.internship_students.create', [
                'internship_program' => $internshipProgram,
                'students' => $students,
                'sidebar' => 'internship-programs',
                'sub_sidebar' => 'students' . request()->get('student_status'),
            ]);
        }
    }

    public function store(Request $request, InternshipProgram $internshipProgram)
    {
        $validatedData = $request->validate([
            'student_id' => 'required',
        ]);

        InternshipStudent::create([
            'student_id' => $validatedData['student_id'],
            'internship_program_id' => $internshipProgram->id
        ]);

        return redirect('/admin/internship-students/2?student_status=' . $internshipProgram->student_status);
    }

    public function destroy(InternshipProgram $internshipProgram, Student $student)
    {
        InternshipStudent::where('student_id', $student->id)->delete();
        return redirect('/admin/internship-students/2?student_status=' . $internshipProgram->student_status);
    }
}
