<?php

namespace App\Http\Controllers\supervisor;

use App\Http\Controllers\Controller;
use App\Models\InternshipProgram;
use App\Models\InternshipStudent;
use App\Models\StudentEvaluation;
use Illuminate\Http\Request;

class StudentEvaluationController extends Controller
{
    public function index(InternshipProgram $internshipProgram)
    {
        return view('dashboard.supervisor.students.evaluations.index', [
            'internship_program' => $internshipProgram,
            'sidebar' => 'internship-programs-' . $internshipProgram->student_status,
        ]);
    }

    public function create(InternshipProgram $internshipProgram, InternshipStudent $internshipStudent)
    {
        return view('dashboard.supervisor.students.evaluations.create', [
            'internship_program' => $internshipProgram,
            'internship_student' => $internshipStudent,
            'sidebar' => 'internship-programs-' . $internshipProgram->student_status,
        ]);
    }

    public function store(Request $request, InternshipProgram $internshipProgram, InternshipStudent $internshipStudent)
    {
        $validatedData = $request->validate([
            'attitude' => 'required',
            'discipline' => 'required',
            'diligence' => 'required',
            'independent_work' => 'required',
            'collaboration' => 'required',
            'accuracy' => 'required',
            'communication' => 'required',
            'creativity' => 'required',
        ]);

        StudentEvaluation::updateOrCreate([
            'internship_student_id' => $internshipStudent->id
        ], $validatedData);

        return redirect('/supervisor/students/' . $internshipProgram->id . '/evaluations?student_status=' . $internshipProgram->student_status);
    }
}
