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
        Schema::table('centres', function (Blueprint $table) {
            $table->string('practo_url')->nullable()->after('phone_appointment');
            $table->string('justdial_url')->nullable()->after('practo_url');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('centres', function (Blueprint $table) {
            $table->dropColumn(['practo_url', 'justdial_url']);
        });
    }
};
