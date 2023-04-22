<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('internship_programs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('employee_id');
            $table->date('start_date');
            $table->date('end_date');
            $table->unsignedTinyInteger('internship_status')->default(1)->comment('1=On Going|2=Done');
            $table->unsignedTinyInteger('student_status')->comment('1=Student|2=College');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('internship_programs');
    }
};
