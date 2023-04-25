<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\InternshipApplication;
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
}
