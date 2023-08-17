<?php

namespace App\Http\Controllers\main;

use App\Http\Controllers\Controller;
use App\Models\Student;
use Carbon\Carbon;

class InternshipProgramController extends Controller
{
    public function certificate(Student $student)
    {
        $evaluation = $student->internshipStudent->evaluation->only('attitude', 'discipline', 'diligence', 'independent_work', 'collaboration', 'accuracy', 'communication', 'creativity');

        $evalutationTable = [];
        foreach ($evaluation as $key => $value) {
            if ($key === 'attitude') {
                $name = 'SIKAP';
            } elseif ($key === 'discipline') {
                $name = 'DISIPLIN';
            } elseif ($key === 'diligence') {
                $name = 'KETEKUNAN';
            } elseif ($key === 'independent_work') {
                $name = 'KERJA MANDIRI';
            } elseif ($key === 'collaboration') {
                $name = 'KERJA SAMA';
            } elseif ($key === 'accuracy') {
                $name = 'KETELITIAN';
            } elseif ($key === 'communication') {
                $name = 'KOMUNIKASI';
            } elseif ($key === 'creativity') {
                $name = 'KREATIFITAS';
            }

            if ($value > 90 && $value <= 100)
                $description = 'A';
            elseif ($value > 70 && $value <= 90)
                $description = 'B';
            elseif ($value > 60 && $value <= 70)
                $description = 'C';
            elseif ($value > 50 && $value <= 60)
                $description = 'D';
            else
                $description = 'E';

            $evalutationTable[] = [
                'name' => $name,
                'value' => $value,
                'description' => $description
            ];
        }


        $start_date = new Carbon($student->internshipStudent->internshipProgram->start_date);
        $end_date = new Carbon($student->internshipStudent->internshipProgram->end_date);
        return view('certificates.certificate', [
            'name' => $student->name,
            'evaluation' => $evaluation,
            'id_number' => $student->id_number,
            'student_status' => $student->student_status,
            'start_date' => $start_date->day . " " . $start_date->locale('ID')->getTranslatedMonthName() . " " . $start_date->year,
            'end_date' => $end_date->day . " " . $end_date->locale('ID')->getTranslatedMonthName() . " " . $end_date->year,
            'evalutationTable' => $evalutationTable
        ]);
    }
}
