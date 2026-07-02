<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
 public function up()
{
    Schema::create('class_subject', function (Blueprint $table) {
        $table->id('Class_Subject_ID');
        $table->foreignId('Class_ID')->constrained('classes', 'Class_ID')->onDelete('cascade');
        $table->foreignId('Subject_ID')->constrained('subjects', 'Subject_ID')->onDelete('cascade');
        $table->foreignId('Teacher_ID')->nullable()->constrained('teachers', 'Teacher_ID')->onDelete('set null');
        $table->timestamps();

        $table->unique(['Class_ID', 'Subject_ID']); // One subject per class once
    });
}
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('class_subject');
    }
};
