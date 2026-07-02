<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('exam_types', function (Blueprint $table) {
            $table->id('Exam_Type_ID');
            $table->string('Type_Name', 30); // Midterm, Final, Quiz, etc.
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('exam_types');
    }
};