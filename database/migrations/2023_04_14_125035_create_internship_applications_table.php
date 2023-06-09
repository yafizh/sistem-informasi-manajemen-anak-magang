<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('internship_applications', function (Blueprint $table) {
            $table->id();
            $table->string('id_number');
            $table->string('name');
            $table->string('email');
            $table->string('institution');
            $table->string('start_date');
            $table->string('end_date');
            $table->date('application_date');
            $table->unsignedTinyInteger('application_status')->default(1)->comment('1=Pending|2=Approved|3=Rejected');
            $table->date('verification_date')->nullable()->default(null);
            $table->unsignedTinyInteger('student_status')->comment('1=Siswa|2=Mahasiswa');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('internship_applications');
    }
};
