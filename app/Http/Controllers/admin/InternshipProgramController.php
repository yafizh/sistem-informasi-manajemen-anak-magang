<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Models\InternshipProgram;
use Carbon\Carbon;
use Illuminate\Http\Request;

class InternshipProgramController extends Controller
{
    public function index()
    {
        if (request()->get('student_status')) {
            $internshipProgram = InternshipProgram::where('student_status', request()->get('student_status'))
                ->orderBy('internship_status', 'DESC')
                ->get()
                ->map(function ($item) {
                    $start_date = new Carbon($item->start_date);
                    $end_date = new Carbon($item->end_date);

                    $item->start_date = $start_date->day . ' ' . $start_date->locale('ID')->getTranslatedDayName() . ' ' . $start_date->year;
                    $item->end_date = $end_date->day . ' ' . $end_date->locale('ID')->getTranslatedDayName() . ' ' . $end_date->year;

                    return $item;
                });

            return view('dashboard.admin.internship_program.index', [
                'sidebar' => 'internship-programs',
                'sub_sidebar' => 'students' . request()->get('student_status'),
                'internship_programs' => $internshipProgram
            ]);
        }
    }

    public function create()
    {
        $employees = Employee::whereHas('user', function ($q) {
            $q->where('status', 'Supervisor');
        })->where(function ($q) {
            $q->whereHas('internshipPrograms', function ($q) {
                $q->where('internship_status', '!=', '1');
            })->orDoesntHave('internshipPrograms');
        })->get();

        return view('dashboard.admin.internship_program.create', [
            'sidebar' => 'internship-programs',
            'sub_sidebar' => 'students' . request()->get('student_status'),
            'employees' => $employees
        ]);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'student_status' => 'required',
            'employee_id' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
        ]);

        InternshipProgram::create($validatedData);

        return redirect('/admin/internship-programs?student_status=' . $validatedData['student_status']);
    }

    public function show(InternshipProgram $internshipProgram)
    {
        return view('dashboard.admin.internship_program.show', [
            'internship_program' => $internshipProgram,
            'sidebar' => 'internship-programs',
            'sub_sidebar' => 'students' . request()->get('student_status'),
        ]);
    }

    public function supervisor(InternshipProgram $internshipProgram)
    {
        return view('dashboard.admin.internship_program.supervisor', [
            'internship_program' => $internshipProgram,
            'sidebar' => 'internship-programs',
            'sub_sidebar' => 'students' . request()->get('student_status'),
        ]);
    }

    public function edit(InternshipProgram $internshipProgram)
    {
        $employees = Employee::whereHas('user', function ($q) {
            $q->where('status', 'Supervisor');
        })->where(function ($q) {
            $q->whereHas('internshipPrograms', function ($q) {
                $q->where('internship_status', '!=', '1');
            })->orDoesntHave('internshipPrograms');
        })->get();

        return view('dashboard.admin.internship_program.edit', [
            'internship_program' => $internshipProgram,
            'sidebar' => 'internship-programs',
            'sub_sidebar' => 'students' . request()->get('student_status'),
            'employees' => $employees
        ]);
    }

    public function update(Request $request, InternshipProgram $internshipProgram)
    {
        $validatedData = $request->validate([
            'employee_id' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
        ]);

        InternshipProgram::find($internshipProgram->id)->update($validatedData);

        return redirect('/admin/internship-programs?student_status=' . $internshipProgram->student_status);
    }

    public function destroy(InternshipProgram $internshipProgram)
    {
        InternshipProgram::destroy($internshipProgram->id);
        return redirect('/admin/internship-programs?student_status=' . $internshipProgram->student_status);
    }
}
