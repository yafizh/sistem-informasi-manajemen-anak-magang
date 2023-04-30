<?php

namespace Database\Seeders;

use App\Models\InternshipApplication;
use App\Models\Student;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class StudentSeeder extends Seeder
{
    public function run(): void
    {
        for ($i = 0; $i < 10; $i++) {
            $id_number = rand(10000000, 99999999);
            $name = 'Nama ' . $i + 1;
            $email = Str::random(10) . "@gmail.com";
            $institution = 'UNISKA';
            $student_status = 2;

            Student::create([
                'user_id' => User::create([
                    'username' => $id_number,
                    'password' => bcrypt($id_number),
                    'status' => 'Student'
                ])->id,
                'internship_application_id' =>  InternshipApplication::create([
                    'id_number' => $id_number,
                    'name' => $name,
                    'email' => $email,
                    'institution' => $institution,
                    'application_date' => Carbon::now(),
                    'start_date' => Carbon::now(),
                    'end_date' => Carbon::now(),
                    'application_status' => 2,
                    'verification_date' => Carbon::now(),
                    'student_status' => $student_status
                ])->id,
                'id_number' => $id_number,
                'name' => $name,
                'birth_place' => 'Martapura',
                'birth_date' => '2000-01-01',
                'sex' => 'Laki - Laki',
                'email' => $email,
                'phone_number' => rand(10000000, 99999999),
                'institution' => $institution,
                'photo' => '',
                'student_status' => $student_status,
            ]);
        }
    }
}
