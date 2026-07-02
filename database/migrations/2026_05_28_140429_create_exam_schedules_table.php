<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('exam_schedules', function (Blueprint $table) {
            $table->id('Schedule_ID');
            $table->foreignId('Exam_ID')->constrained('exams', 'Exam_ID')->onDelete('cascade');
            $table->foreignId('Class_ID')->constrained('classes', 'Class_ID')->onDelete('cascade');
            $table->foreignId('Subject_ID')->constrained('subjects', 'Subject_ID')->onDelete('cascade');
            $table->foreignId('Exam_Type_ID')->constrained('exam_types', 'Exam_Type_ID')->onDelete('cascade');
            $table->date('Exam_Date');
            $table->integer('Max_Marks')->unsigned();
            $table->integer('Duration_Minutes')->unsigned()->default(180);
            $table->timestamps();

            $table->unique(['Exam_ID', 'Class_ID', 'Subject_ID']); // Prevent duplicate schedules
        });
    }

    public function down()
    {
        Schema::dropIfExists('exam_schedules');
    }
};