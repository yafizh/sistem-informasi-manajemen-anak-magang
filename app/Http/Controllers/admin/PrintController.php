<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\InternshipApplication;
use App\Models\InternshipProgram;
use App\Models\Student;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PrintController extends Controller
{
    public function internshipApplication()
    {
        $internship_applications = null;
        if (!empty(request()->get('f')) && !empty(request()->get('t'))) {
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


        $today = new Carbon();
        $f = new Carbon(request()->get('f'));
        $t = new Carbon(request()->get('t'));
        return view('dashboard.admin.prints.internship_application', [
            'f' => !empty(request()->get('f')) ? $f->day . ' ' . $f->locale('ID')->getTranslatedMonthName() . ' ' . $f->year : null,
            't' => !empty(request()->get('t')) ? $t->day . ' ' . $t->locale('ID')->getTranslatedMonthName() . ' ' . $t->year : null,
            'today' => $today->day . ' ' . $today->locale('ID')->getTranslatedMonthName() . ' ' . $today->year,
            'internship_applications' => $internship_applications
        ]);
    }

    public function internshipProgram()
    {
        $internship_programs = null;
        if (!empty(request()->get('f')) && !empty(request()->get('t'))) {
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


        $today = new Carbon();
        $f = new Carbon(request()->get('f'));
        $t = new Carbon(request()->get('t'));
        return view('dashboard.admin.prints.internship_program', [
            'f' => !empty(request()->get('f')) ? $f->day . ' ' . $f->locale('ID')->getTranslatedMonthName() . ' ' . $f->year : null,
            't' => !empty(request()->get('t')) ? $t->day . ' ' . $t->locale('ID')->getTranslatedMonthName() . ' ' . $t->year : null,
            'today' => $today->day . ' ' . $today->locale('ID')->getTranslatedMonthName() . ' ' . $today->year,
            'internship_programs' => $internship_programs
        ]);
    }

    public function student()
    {
        $students = null;
        if (!empty(request()->get('f')) && !empty(request()->get('t'))) {
            $students =
                Student::where('student_status', request()->get('student_status'))
                ->whereHas('internshipApplication', function ($q) {
                    $q->where('verification_date', '>=', request()->get('f'))
                        ->where('verification_date', '<=', request()->get('t'));
                })->get();
        } else
            $students = Student::where('student_status', request()->get('student_status'))->get();

        $students = $students->map(function ($student) {
            $verification_date = new Carbon($student->internshipApplication->verification_date);
            $student->internshipApplication->verification_date = $verification_date->day . " " . $verification_date->locale('ID')->getTranslatedMonthName() . " " . $verification_date->year;

            return $student;
        });

        $today = new Carbon();
        $f = new Carbon(request()->get('f'));
        $t = new Carbon(request()->get('t'));
        return view('dashboard.admin.prints.student', [
            'f' => !empty(request()->get('f')) ? $f->day . ' ' . $f->locale('ID')->getTranslatedMonthName() . ' ' . $f->year : null,
            't' => !empty(request()->get('t')) ? $t->day . ' ' . $t->locale('ID')->getTranslatedMonthName() . ' ' . $t->year : null,
            'today' => $today->day . ' ' . $today->locale('ID')->getTranslatedMonthName() . ' ' . $today->year,
            'students' => $students
        ]);
    }
}
