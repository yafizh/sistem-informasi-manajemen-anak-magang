<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\InternshipApplication;
use Carbon\Carbon;
use Illuminate\Http\Request;

class InternshipApplicationController extends Controller
{
    public function index()
    {
        $status = 1;
        return view('dashboard.admin.internship_application.index', [
            'sidebar' => 'internship-applications',
            'sub_sidebar' => 'pending',
            'status' => $status,
            'internship_applications' => InternshipApplication::where('application_status', $status)->orderBy('id', 'DESC')->get()
        ]);
    }

    public function show(InternshipApplication $internshipApplication)
    {

        if ($internshipApplication->application_status == '1')
            $sub_sidebar = "pending";

        if ($internshipApplication->application_status == 2)
            $sub_sidebar = "approved";

        if ($internshipApplication->application_status == 3)
            $sub_sidebar = "rejected";

        $start_date = new Carbon($internshipApplication->start_date);
        $end_date = new Carbon($internshipApplication->end_date);

        $internshipApplication->start_date = $start_date->day . ' ' . $start_date->locale('ID')->getTranslatedMonthName() . ' ' . $start_date->year;
        $internshipApplication->end_date = $end_date->day . ' ' . $end_date->locale('ID')->getTranslatedMonthName() . ' ' . $end_date->year;
        return view('dashboard.admin.internship_application.show', [
            'sidebar' => 'internship-applications',
            'sub_sidebar' => $sub_sidebar,
            'internship_application' => $internshipApplication
        ]);
    }

    public function approve(InternshipApplication $internshipApplication)
    {
        InternshipApplication::where('id', $internshipApplication->id)->update([
            'verification_date' => Carbon::now()->toDateString(),
            'application_status' => 2
        ]);

        return redirect('/admin/internship-application/approved');
    }

    public function approved()
    {
        $status = 2;
        return view('dashboard.admin.internship_application.index', [
            'sidebar' => 'internship-applications',
            'sub_sidebar' => 'approved',
            'status' => $status,
            'internship_applications' => InternshipApplication::where('application_status', $status)->orderBy('id', 'DESC')->get()
        ]);
    }

    public function reject(InternshipApplication $internshipApplication)
    {
        InternshipApplication::where('id', $internshipApplication->id)->update([
            'verification_date' => Carbon::now()->toDateString(),
            'application_status' => 3
        ]);

        return redirect('/admin/internship-application/rejected');
    }

    public function rejected()
    {
        $status = 3;
        return view('dashboard.admin.internship_application.index', [
            'sidebar' => 'internship-applications',
            'sub_sidebar' => 'rejected',
            'status' => $status,
            'internship_applications' => InternshipApplication::where('application_status', $status)->orderBy('id', 'DESC')->get()
        ]);
    }

    public function destroy(InternshipApplication $internshipApplication)
    {
        InternshipApplication::destroy($internshipApplication->id);
        return redirect()->back();
    }
}
