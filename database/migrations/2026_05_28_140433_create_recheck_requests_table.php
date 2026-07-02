<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('recheck_requests', function (Blueprint $table) {
            $table->id('Request_ID');
            $table->foreignId('Student_ID')->constrained('students', 'Student_ID')->onDelete('cascade');
            $table->foreignId('Marks_ID')->constrained('student_marks', 'Marks_ID')->onDelete('cascade');
            $table->text('Reason');
            $table->enum('Status', ['Pending', 'Approved', 'Rejected'])->default('Pending');
            $table->decimal('New_Marks', 5, 2)->nullable();
            $table->timestamp('Request_Date')->useCurrent();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('recheck_requests');
    }
};