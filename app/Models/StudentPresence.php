<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentPresence extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function internshipStudent()
    {
        return $this->belongsTo(InternshipStudent::class);
    }
}
