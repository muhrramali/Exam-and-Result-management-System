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
    Schema::create('classes', function (Blueprint $table) {
        $table->id('Class_ID');
        $table->string('Class_Name', 50);
        $table->integer('Capacity')->unsigned();
        $table->foreignId('Academic_Year_ID')->constrained('academic_years', 'Year_ID')->onDelete('cascade');
        $table->timestamps();
    });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('classes');
    }
};
