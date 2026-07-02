<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('exams', function (Blueprint $table) {
            $table->id('Exam_ID');
            $table->string('Exam_Name', 50);
            $table->foreignId('Academic_Year_ID')->constrained('academic_years', 'Year_ID')->onDelete('cascade');
            $table->date('Start_Date');
            $table->date('End_Date');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('exams');
    }
};