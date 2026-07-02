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
        Schema::create('academic_years', function (Blueprint $table) {
            $table->id('Year_ID');
            $table->string('Session', 20);
            $table->date('Start_Date');
            $table->date('End_Date');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('academic_years');
    }
};