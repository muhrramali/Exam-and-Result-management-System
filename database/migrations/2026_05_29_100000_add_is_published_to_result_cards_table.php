<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('result_cards', function (Blueprint $table) {
            $table->boolean('Is_Published')->default(false)->after('Pass_Status');
        });
    }

    public function down(): void
    {
        Schema::table('result_cards', function (Blueprint $table) {
            $table->dropColumn('Is_Published');
        });
    }
};
