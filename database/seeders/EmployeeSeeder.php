<?php

namespace Database\Seeders;

use App\Models\Employee;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EmployeeSeeder extends Seeder
{
    public function run(): void
    {
        $nip = "123456789";

        Employee::create([
            'user_id' => User::create([
                'username' => $nip,
                'password' => bcrypt($nip),
                'status' => 'Supervisor',
            ])->id,
            'id_number' => $nip,
            'name' => 'Muhammad Zida',
            'birth_place' => 'Martapura',
            'birth_date' => '2000-01-01',
            'sex' => 'Laki - Laki',
            'email' => 'zida@gmail.com',
            'phone_number' => '192732891',
            'photo' => '',
        ]);
    }
}
