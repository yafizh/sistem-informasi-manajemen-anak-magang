<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\InternshipApplication;
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
}
