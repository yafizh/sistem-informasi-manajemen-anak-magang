<?php

namespace App\Http\Controllers\supervisor;

use App\Http\Controllers\Controller;
use App\Models\InternshipProgram;
use App\Models\StudentPresence;
use Carbon\Carbon;
use Illuminate\Http\Request;

class StudentPresenceController extends Controller
{
    public function index(InternshipProgram $internshipProgram)
    {
        $internshipProgram->studentPresences->map(function ($item) {
            $date = new Carbon($item->date);
            $item->formated_date = $date->day . ' ' . $date->locale('ID')->getTranslatedMonthName() . ' ' . $date->year;
            return $item;
        });
        return view('dashboard.supervisor.students.presences.index', [
            'internship_program' => $internshipProgram,
            'sidebar' => 'internship-programs-' . request()->get('student_status'),
        ]);
    }

    public function table(InternshipProgram $internshipProgram)
    {
        $filters = [
            'month' => [],
            'year' => []
        ];

        $start_date = new Carbon($internshipProgram->start_date);
        $end_date = new Carbon($internshipProgram->end_date);
        $end_date->addMonth();
        while (!$start_date->eq($end_date)) {
            $filters['month'][] = [
                'name' => $start_date->locale('ID')->getTranslatedMonthName(),
                'value' => $start_date->month
            ];

            $start_date->addMonth();
        }

        $start_date = new Carbon($internshipProgram->start_date);
        $end_date = new Carbon($internshipProgram->end_date);
        $end_date->addYear();
        while (!$start_date->eq($end_date)) {
            $filters['year'][] = [
                'name' => $start_date->year,
                'value' => $start_date->year
            ];

            $start_date->addYear();
        }

        if (request()->get('month') && request()->get('year')) {
            $presence_table = [];

            foreach ($internshipProgram->internshipStudents as $internshipStudent) {
                $last_day_of_month = Carbon::create()
                    ->day(1)
                    ->month(request()->get('month'))
                    ->year(request()->get('year'))
                    ->endOfMonth()
                    ->day;

                $presences  = [];
                for ($i = 1; $i <= $last_day_of_month; $i++) {
                    $presence = StudentPresence::where('internship_student_id', $internshipStudent->id)
                        ->whereRaw('DAY(date) = ?', $i)
                        ->whereRaw('MONTH(date) = ?', request()->get('month'))
                        ->whereRaw('YEAR(date) = ?', request()->get('year'));

                    $presences[] = $presence->count() ? $presence->first()->status : '-';
                }

                $presence_table[] = [
                    'id_number' => $internshipStudent->student->id_number,
                    'name' => $internshipStudent->student->name,
                    'presences' => $presences
                ];
            }
        }

        return view('dashboard.supervisor.students.presences.table', [
            'internship_program' => $internshipProgram,
            'presence_table' => $presence_table ?? null,
            'last_day_of_month' => $last_day_of_month ?? null,
            'filters' => $filters,
            'choosed_month' => request()->get('month'),
            'choosed_year' => request()->get('year'),
            'sidebar' => 'internship-programs-' . request()->get('student_status'),
        ]);
    }

    public function create(InternshipProgram $internshipProgram)
    {
        return view('dashboard.supervisor.students.presences.create', [
            'internship_program' => $internshipProgram,
            'sidebar' => 'internship-programs-' . request()->get('student_status'),
        ]);
    }

    public function store(Request $request, InternshipProgram $internshipProgram)
    {
        $validatedData = $request->validate([
            'start_date' => 'required',
            'end_date' => 'required'
        ]);

        $start_date = new Carbon($validatedData['start_date']);
        $end_date = new Carbon($validatedData['end_date']);
        $end_date->addDay();

        while (!$start_date->eq($end_date)) {
            foreach ($internshipProgram->internshipStudents as $internshipStudent) {
                StudentPresence::updateOrCreate([
                    'internship_student_id' => $internshipStudent->id,
                    'date' => $start_date,
                ], [
                    'status' => null,
                ]);
            }
            $start_date->addDay();
        }

        return redirect('/supervisor/students/' . $internshipProgram->id . '/presences?student_status=' . $internshipProgram['student_status']);
    }

    public function edit(InternshipProgram $internshipProgram, StudentPresence $studentPresence)
    {
        $date = new Carbon($studentPresence->date);
        $studentPresence->date = $date->day . " " . $date->locale('ID')->getTranslatedMonthName() . " " . $date->year;

        return view('dashboard.supervisor.students.presences.edit', [
            'internship_program' => $internshipProgram,
            'student_presence' => $studentPresence,
            'sidebar' => 'internship-programs-' . $internshipProgram->student_status,
        ]);
    }

    public function update(Request $request, InternshipProgram $internshipProgram, StudentPresence $studentPresence)
    {
        StudentPresence::where('id', $studentPresence->id)->update(['status' => $request->get('status')]);
        return redirect('/supervisor/students/' . $internshipProgram->id . '/presences?student_status=' . $internshipProgram['student_status']);
    }

    public function destroy(InternshipProgram $internshipProgram, StudentPresence $studentPresence)
    {
        StudentPresence::destroy('id', $studentPresence->id);
        return redirect('/supervisor/students/' . $internshipProgram->id . '/presences?student_status=' . $internshipProgram['student_status']);
    }
}
