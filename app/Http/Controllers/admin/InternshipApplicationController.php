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
        $status = "Pending";
        return view('dashboard.admin.internship_application.index', [
            'status' => $status,
            'internship_applications' => InternshipApplication::where('status', $status)->orderBy('id', 'DESC')->get()
        ]);
    }

    public function show(InternshipApplication $internshipApplication)
    {
        $start_date = new Carbon($internshipApplication->start_date);
        $end_date = new Carbon($internshipApplication->end_date);

        $internshipApplication->start_date = $start_date->day . ' ' . $start_date->locale('ID')->getTranslatedMonthName() . ' ' . $start_date->year;
        $internshipApplication->end_date = $end_date->day . ' ' . $end_date->locale('ID')->getTranslatedMonthName() . ' ' . $end_date->year;
        return view('dashboard.admin.internship_application.show', [
            'internship_application' => $internshipApplication
        ]);
    }

    public function approve(InternshipApplication $internshipApplication)
    {
        InternshipApplication::where('id', $internshipApplication->id)->update([
            'status' => 'Approved'
        ]);

        return redirect('/admin/internship-application/approved');
    }

    public function approved()
    {
        $status = "Approved";
        return view('dashboard.admin.internship_application.index', [
            'status' => $status,
            'internship_applications' => InternshipApplication::where('status', $status)->orderBy('id', 'DESC')->get()
        ]);
    }

    public function reject(InternshipApplication $internshipApplication)
    {
        InternshipApplication::where('id', $internshipApplication->id)->update([
            'status' => 'Rejected'
        ]);

        return redirect('/admin/internship-application/rejected');
    }

    public function rejected()
    {
        $status = "Rejected";
        return view('dashboard.admin.internship_application.index', [
            'status' => $status,
            'internship_applications' => InternshipApplication::where('status', $status)->orderBy('id', 'DESC')->get()
        ]);
    }

    public function destroy(InternshipApplication $internshipApplication)
    {
        InternshipApplication::destroy($internshipApplication->id);
        return redirect()->back();
    }
}