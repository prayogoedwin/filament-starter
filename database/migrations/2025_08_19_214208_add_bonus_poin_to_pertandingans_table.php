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
        Schema::table('pertandingans', function (Blueprint $table) {
            $table->integer('bonus_poin')
                ->after('ronde_poin')
                ->nullable(); // bisa nullable kalau belum ada data
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pertandingans', function (Blueprint $table) {
            $table->dropColumn('bonus_poin');
        });
    }
};
