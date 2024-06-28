<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignId('grade_id');
            $table->foreignId('student_parent_id');
            $table->foreignId('ta_student_id');
            $table->string('name');
            $table->integer('discount')->nullable();
            $table->string('nis');
            $table->string('nisn');
            $table->string('nik');
            $table->string('status')->default('AKTIF');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
