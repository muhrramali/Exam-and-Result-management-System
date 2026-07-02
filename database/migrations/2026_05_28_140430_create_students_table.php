<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->id('Student_ID');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('Roll_No', 20)->unique();
            $table->string('Full_Name', 100);
            $table->date('Date_Of_Birth')->nullable();
            $table->enum('Gender', ['Male', 'Female', 'Other'])->nullable();
            $table->string('Contact', 50)->nullable();
            $table->foreignId('Section_ID')->nullable()->constrained('sections', 'Section_ID')->onDelete('set null');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('students');
    }
};