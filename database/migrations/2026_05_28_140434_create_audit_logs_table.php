<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('audit_logs', function (Blueprint $table) {
            $table->id('Log_ID');
            $table->string('Table_Name', 50);
            $table->integer('Record_ID');
            $table->text('Old_Value')->nullable();
            $table->text('New_Value')->nullable();
            $table->foreignId('Changed_By')->nullable()->constrained('users', 'id');
            $table->timestamp('Change_Date')->useCurrent();
            $table->text('Reason')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('audit_logs');
    }
};