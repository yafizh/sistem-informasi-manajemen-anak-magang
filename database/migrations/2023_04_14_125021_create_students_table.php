<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->foreignId('internship_application_id');
            $table->string('id_number');
            $table->string('name');
            $table->string('birth_place')->nullable();
            $table->date('birth_date')->nullable();
            $table->string('sex')->nullable();
            $table->string('email');
            $table->string('phone_number')->nullable();
            $table->string('institution');
            $table->string('photo')->nullable();
            $table->unsignedTinyInteger('student_status')->comment('1=Siswa|2=Mahasiswa');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
