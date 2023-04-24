<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('student_evaluations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('internship_student_id');
            $table->unsignedInteger('attitude');
            $table->unsignedInteger('discipline');
            $table->unsignedInteger('diligence');
            $table->unsignedInteger('independent_work');
            $table->unsignedInteger('collaboration');
            $table->unsignedInteger('accuracy');
            $table->unsignedInteger('communication');
            $table->unsignedInteger('creativity');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('student_evaluations');
    }
};
