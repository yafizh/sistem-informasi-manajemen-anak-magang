<?php

namespace App\Http\Controllers\student;

use App\Http\Controllers\Controller;
use App\Models\StudentPresence;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StudentPresenceController extends Controller
{
    public function index()
    {
        $student_presence = Auth::user()->student->internshipStudent->presences->filter(function ($presences) {
            return $presences->date <= Date("Y-m-d");
        });

        $student_presence = $student_presence->map(function ($presences) {
            $date = new Carbon($presences->date);
            $presences->date = $date->locale('ID')->getTranslatedDayName() . ', ' . $date->day . ' ' . $date->locale('ID')->getTranslatedMonthName() . ' ' . $date->year;
            return $presences;
        });

        return view('dashboard.student.presences.index', [
            'sidebar' => 'presences',
            'student_presence' => $student_presence
        ]);
    }

    public function edit(StudentPresence $studentPresence)
    {
        $date = new Carbon($studentPresence->date);
        $studentPresence->date = $date->locale('ID')->getTranslatedDayName() . ', ' . $date->day . ' ' . $date->locale('ID')->getTranslatedMonthName() . ' ' . $date->year;
        return view('dashboard.student.presences.edit', [
            'student_presence' => $studentPresence,
            'sidebar' => 'presences'
        ]);
    }

    public function update(Request $request, StudentPresence $studentPresence)
    {
        $validatedData = $request->validate([
            'activity' => 'required',
        ]);

        $validatedData['status'] = 1;

        StudentPresence::find($studentPresence->id)->update($validatedData);

        return redirect('/student/presences');
    }

    public function table()
    {
        $internshipProgram = Auth::user()->student->internshipStudent->internshipProgram;
        $start_date = new Carbon($internshipProgram->start_date);
        $end_date = new Carbon($internshipProgram->end_date);

        $table = [];

        $end_date->addMonth();
        while (!$start_date->eq($end_date)) {
            $presences = [];
            for ($i = 1; $i <= 31; $i++) {
                $presence = StudentPresence::where('internship_student_id', Auth::user()->student->internshipStudent->id)
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

        return view('dashboard.student.presences.table', [
            'table' => $table,
            'sidebar' => 'table-presences'
        ]);
    }
}
