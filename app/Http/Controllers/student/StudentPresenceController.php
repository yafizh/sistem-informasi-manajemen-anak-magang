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
}
