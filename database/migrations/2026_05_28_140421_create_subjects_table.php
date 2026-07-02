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
    Schema::create('subjects', function (Blueprint $table) {
        $table->id('Subject_ID');
        $table->string('Subject_Code', 20)->unique();
        $table->string('Subject_Name', 100);
        $table->integer('Credits')->default(1);
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subjects');
    }
};
