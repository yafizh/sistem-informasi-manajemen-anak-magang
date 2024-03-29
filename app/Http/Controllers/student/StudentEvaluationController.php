<?php

namespace App\Http\Controllers\student;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class StudentEvaluationController extends Controller
{
    public function index()
    {
        $evaluation = Auth::user()->student->internshipStudent->evaluation ?? null;
        $average = array_sum([
            $evaluation->attitude ?? 0,
            $evaluation->discipline ?? 0,
            $evaluation->diligence ?? 0,
            $evaluation->independent_work ?? 0,
            $evaluation->collaboration ?? 0,
            $evaluation->accuracy ?? 0,
            $evaluation->communication ?? 0,
            $evaluation->creativity ?? 0,
        ]) / 8;

        return view('dashboard.student.evaluations.index', [
            'supervisor' => Auth::user()->student->internshipStudent->internshipProgram->supervisor,
            'evaluation' => $evaluation,
            'average' => $average,
            'sidebar' => 'evaluations',
            'internship_status' => Auth::user()->student->internshipStudent->internshipProgram->internship_status,
        ]);
    }
}
