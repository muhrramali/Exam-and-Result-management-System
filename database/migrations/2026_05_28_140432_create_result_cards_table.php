<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('result_cards', function (Blueprint $table) {
            $table->id('Result_ID');
            $table->foreignId('Student_ID')->constrained('students', 'Student_ID')->onDelete('cascade');
            $table->foreignId('Exam_ID')->constrained('exams', 'Exam_ID')->onDelete('cascade');
            $table->foreignId('Academic_Year_ID')->constrained('academic_years', 'Year_ID')->onDelete('cascade');
            $table->decimal('Total_Marks', 6, 2)->default(0);
            $table->decimal('Percentage', 5, 2)->default(0);
            $table->string('Overall_Grade', 5)->nullable();
            $table->integer('Class_Rank')->nullable();
            $table->boolean('Pass_Status')->default(false);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('result_cards');
    }
};