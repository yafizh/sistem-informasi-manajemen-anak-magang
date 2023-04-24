<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InternshipProgram extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function supervisor()
    {
        return $this->belongsTo(Employee::class, 'employee_id', 'id');
    }

    public function students()
    {
        return $this->belongsToMany(Student::class, 'internship_students', 'internship_program_id', 'student_id');
    }

    public function internshipStudents()
    {
        return $this->hasMany(InternshipStudent::class);
    }

    public function studentPresences()
    {
        return $this->hasManyThrough(StudentPresence::class, InternshipStudent::class)->orderBy('date', 'DESC');
    }
}
