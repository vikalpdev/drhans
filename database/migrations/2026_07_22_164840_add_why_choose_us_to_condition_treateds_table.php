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
        Schema::table('condition_treateds', function (Blueprint $table) {
            $table->longText('why_choose_us')->nullable()->after('prevention');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('condition_treateds', function (Blueprint $table) {
            $table->dropColumn('why_choose_us');
        });
    }
};
