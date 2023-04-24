<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InternshipStudent extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function evaluation()
    {
        return $this->hasOne(StudentEvaluation::class);
    }

    public function presences()
    {
        return $this->hasMany(StudentPresence::class)->orderBy('date', 'DESC');
    }

    public function internshipProgram()
    {
        return $this->belongsTo(internshipProgram::class);
    }
}
