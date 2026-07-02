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
    Schema::create('sections', function (Blueprint $table) {
        $table->id('Section_ID');
        $table->string('Section_Name', 10); // A, B, C, etc.
        $table->foreignId('Class_ID')->constrained('classes', 'Class_ID')->onDelete('cascade');
        $table->timestamps();
    });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sections');
    }
};
