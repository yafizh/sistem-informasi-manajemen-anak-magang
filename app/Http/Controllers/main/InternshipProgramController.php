<?php

namespace App\Http\Controllers\main;

use App\Http\Controllers\Controller;
use App\Models\Student;
use Carbon\Carbon;

class InternshipProgramController extends Controller
{
    public function certificate(Student $student)
    {
        $evaluation = collect($student->internshipStudent->evaluation->only('attitude', 'discipline', 'diligence', 'independent_work', 'collaboration', 'accuracy', 'communication', 'creativity'));
        $evaluation = round($evaluation->sum() / 8);
        if ($evaluation > 90 && $evaluation <= 100)
            $evaluation = 'A';
        elseif ($evaluation > 70 && $evaluation <= 90)
            $evaluation = 'B';
        elseif ($evaluation > 60 && $evaluation <= 70)
            $evaluation = 'C';
        elseif ($evaluation > 50 && $evaluation <= 60)
            $evaluation = 'D';
        else
            $evaluation = 'E';

        $start_date = new Carbon($student->internshipStudent->internshipProgram->start_date);
        $end_date = new Carbon($student->internshipStudent->internshipProgram->end_date);
        return view('certificates.certificate', [
            'name' => $student->name,
            'evaluation' => $evaluation,
            'id_number' => $student->id_number,
            'student_status' => $student->student_status,
            'start_date' => $start_date->day . " " . $start_date->locale('ID')->getTranslatedMonthName() . " " . $start_date->year,
            'end_date' => $end_date->day . " " . $end_date->locale('ID')->getTranslatedMonthName() . " " . $end_date->year,
        ]);
    }
}
