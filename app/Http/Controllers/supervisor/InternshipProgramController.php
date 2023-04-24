<?php

namespace App\Http\Controllers\supervisor;

use App\Http\Controllers\Controller;
use App\Models\InternshipProgram;
use App\Models\StudentPresence;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InternshipProgramController extends Controller
{
    public function index()
    {
        if (request()->get('student_status')) {
            $internshipProgram = InternshipProgram::where('student_status', request()->get('student_status'))
                ->where('employee_id', Auth::user()->employee->id)
                ->orderBy('internship_status', 'DESC')
                ->get()
                ->map(function ($item) {
                    $start_date = new Carbon($item->start_date);
                    $end_date = new Carbon($item->end_date);

                    $item->start_date = $start_date->day . ' ' . $start_date->locale('ID')->getTranslatedDayName() . ' ' . $start_date->year;
                    $item->end_date = $end_date->day . ' ' . $end_date->locale('ID')->getTranslatedDayName() . ' ' . $end_date->year;

                    return $item;
                });

            return view('dashboard.supervisor.internship_programs.index', [
                'sidebar' => 'internship-programs-' . request()->get('student_status'),
                'internship_programs' => $internshipProgram
            ]);
        }
    }

    public function show(InternshipProgram $internshipProgram)
    {
        $start_date = new Carbon($internshipProgram->start_date);
        $end_date = new Carbon($internshipProgram->end_date);

        $internshipProgram->start_date = $start_date->day . ' ' . $start_date->locale('ID')->getTranslatedMonthName() . ' ' . $start_date->year;
        $internshipProgram->end_date = $end_date->day . ' ' . $end_date->locale('ID')->getTranslatedMonthName() . ' ' . $end_date->year;

        return view('dashboard.supervisor.internship_programs.show', [
            'internship_program' => $internshipProgram,
            'sidebar' => 'internship-programs-' . request()->get('student_status'),
        ]);
    }
}
