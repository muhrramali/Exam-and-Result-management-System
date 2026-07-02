<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('student_marks', function (Blueprint $table) {
            $table->id('Marks_ID');
            $table->foreignId('Student_ID')->constrained('students', 'Student_ID')->onDelete('cascade');
            $table->foreignId('Schedule_ID')->constrained('exam_schedules', 'Schedule_ID')->onDelete('cascade');
            $table->decimal('Obtained_Marks', 5, 2)->default(0);
            $table->string('Grade', 5)->nullable();
            $table->decimal('Percentage', 5, 2)->nullable(); // Can be calculated
            $table->timestamps();

            $table->unique(['Student_ID', 'Schedule_ID']); // One mark per student per schedule
        });
    }

    public function down()
    {
        Schema::dropIfExists('student_marks');
    }
};