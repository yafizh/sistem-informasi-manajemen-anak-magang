<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\InternshipApplication;
use App\Models\InternshipProgram;
use App\Models\Student;
use App\Models\StudentPresence;
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

    public function studentPresence()
    {
        $presences = null;
        if (!empty(request()->get('f')) && !empty(request()->get('t'))) {
            $presences =
                StudentPresence::whereHas('internshipStudent', function ($q) {
                    $q->whereHas('student', function ($q) {
                        $q->where('student_status', request()->get('student_status'));
                    });
                })
                ->where('date', '>=', request()->get('f'))
                ->where('date', '<=', request()->get('t'))
                ->get();
        } else
            $presences =
                StudentPresence::whereHas('internshipStudent', function ($q) {
                    $q->whereHas('student', function ($q) {
                        $q->where('student_status', request()->get('student_status'));
                    });
                })->get();

        $presences = $presences->map(function ($presence) {
            $date = new Carbon($presence->date);
            $presence->date = $date->day . " " . $date->locale('ID')->getTranslatedMonthName() . " " . $date->year;

            return $presence;
        });

        $today = new Carbon();
        $f = new Carbon(request()->get('f'));
        $t = new Carbon(request()->get('t'));
        return view('dashboard.admin.prints.student_presence', [
            'f' => !empty(request()->get('f')) ? $f->day . ' ' . $f->locale('ID')->getTranslatedMonthName() . ' ' . $f->year : null,
            't' => !empty(request()->get('t')) ? $t->day . ' ' . $t->locale('ID')->getTranslatedMonthName() . ' ' . $t->year : null,
            'today' => $today->day . ' ' . $today->locale('ID')->getTranslatedMonthName() . ' ' . $today->year,
            'presences' => $presences
        ]);
    }

    public function studentPresenceTable()
    {
        $student = Student::find(request()->get('student_id'));
        if ($student->internshipStudent) {
            $internshipProgram = $student->internshipStudent->internshipProgram;
            $start_date = new Carbon($internshipProgram->start_date);
            $end_date = new Carbon($internshipProgram->end_date);

            $table = [];

            $end_date->addMonth();
            while ($start_date->month != $end_date->month) {
                $presences = [];
                for ($i = 1; $i <= 31; $i++) {
                    $presence = StudentPresence::where('internship_student_id', $student->internshipStudent->id)
                        ->whereRaw('DAY(date) = ?', $i)
                        ->whereRaw('MONTH(date) = ?', $start_date->month)
                        ->whereRaw('YEAR(date) = ?', $start_date->year);

                    $presences[] = $presence->count() ? $presence->first()->status : '-';
                }

                $table[] = [
                    'date' => $start_date->locale('ID')->getTranslatedMonthName() . ' ' . $start_date->year,
                    'presences' => $presences,
                ];

                $start_date->addMonth();
            }
        }

        $today = new Carbon();
        return view('dashboard.admin.prints.student_presence_table', [
            'student' => $student,
            'today' => $today->day . ' ' . $today->locale('ID')->getTranslatedMonthName() . ' ' . $today->year,
            'table' => $table ?? null
        ]);
    }
}
