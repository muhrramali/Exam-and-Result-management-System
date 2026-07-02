<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('grading_scales', function (Blueprint $table) {
            $table->id('Scale_ID');
            $table->string('Grade_Letter', 5);
            $table->decimal('Min_Percent', 5, 2);
            $table->decimal('Max_Percent', 5, 2);
            $table->decimal('Grade_Point', 3, 2);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('grading_scales');
    }
};