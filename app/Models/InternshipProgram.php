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
}
