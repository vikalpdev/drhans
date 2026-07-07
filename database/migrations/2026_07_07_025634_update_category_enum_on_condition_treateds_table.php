<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::statement("ALTER TABLE condition_treateds MODIFY category ENUM(
            'ear', 'nose_sinus', 'throat', 'vertigo_balance',
            'tinnitus', 'pediatric', 'speech_disorders', 'head_neck'
        )");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("ALTER TABLE condition_treateds MODIFY category ENUM(
            'ear', 'nose_sinus', 'throat', 'head_neck',
            'hearing_balance', 'pediatric', 'sleep', 'allergy'
        )");
    }
};
