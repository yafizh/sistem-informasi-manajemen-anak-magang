<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('student_presences', function (Blueprint $table) {
            $table->id();
            $table->foreignId('internship_student_id');
            $table->date('date');
            $table->text('activity')->nullable();
            $table->unsignedTinyInteger('status')->nullable()->comment('NULL=Alpa|1=Hadir|2=Sakit|3=Izin');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('student_presences');
    }
};
