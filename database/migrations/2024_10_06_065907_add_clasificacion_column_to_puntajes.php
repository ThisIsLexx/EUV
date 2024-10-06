<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('puntajes', function (Blueprint $table) {
            $table->string('clasificacion')->nullable()->after('puntaje');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('puntajes', function (Blueprint $table) {
            $table->dropColumn('clasificacion');
        });
    }
};
