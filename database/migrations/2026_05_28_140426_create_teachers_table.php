<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('teachers', function (Blueprint $table) {
            $table->id('Teacher_ID');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('Full_Name', 100);
            $table->string('Qualification', 100)->nullable();
            $table->string('Contact', 50)->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('teachers');
    }
};