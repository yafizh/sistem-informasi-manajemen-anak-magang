<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\InternshipApplication;
use App\Models\InternshipProgram;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function internshipApplication()
    {
        $internship_applications = null;
        if (request()->get('f') && request()->get('t')) {
            $internship_applications =
                InternshipApplication::where('application_date', '>=', request()->get('f'))
                ->where('application_date', '<=', request()->get('t'))
                ->get();
        } else
            $internship_applications = InternshipApplication::all();

        $internship_applications = $internship_applications->map(function ($internship_application) {
            $application_date = new Carbon($internship_application->application_date);
            $internship_application->application_date = $application_date->day . " " . $application_date->locale('ID')->getTranslatedMonthName() . " " . $application_date->year;
            return $internship_application;
        });


        return view('dashboard.admin.reports.internship_application', [
            'sidebar' => 'report',
            'sub_sidebar' => 'internship-applications',
            'internship_applications' => $internship_applications
        ]);
    }

    public function internshipProgram()
    {
        $internship_programs = null;
        if (request()->get('f') && request()->get('t')) {
            $internship_programs =
                InternshipProgram::where(function ($q) {
                    $q->where('start_date', '>=', request()->get('f'))
                        ->where('start_date', '<=', request()->get('t'));
                })
                ->orWhere(function ($q) {
                    $q->where('end_date', '>=', request()->get('f'))
                        ->where('end_date', '<=', request()->get('t'));
                })
                ->get();
        } else
            $internship_programs = InternshipProgram::all();

        $internship_programs = $internship_programs->map(function ($internship_program) {
            $start_date = new Carbon($internship_program->start_date);
            $internship_program->start_date = $start_date->day . " " . $start_date->locale('ID')->getTranslatedMonthName() . " " . $start_date->year;

            $end_date = new Carbon($internship_program->end_date);
            $internship_program->end_date = $end_date->day . " " . $end_date->locale('ID')->getTranslatedMonthName() . " " . $end_date->year;
            return $internship_program;
        });


        return view('dashboard.admin.reports.internship_program', [
            'sidebar' => 'report',
            'sub_sidebar' => 'internship-programs',
            'internship_programs' => $internship_programs
        ]);
    }
}
