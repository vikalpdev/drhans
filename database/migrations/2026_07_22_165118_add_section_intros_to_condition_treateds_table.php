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
            $table->string('symptoms_intro')->nullable()->after('symptoms');
            $table->string('causes_intro')->nullable()->after('causes');
            $table->string('diagnosis_intro')->nullable()->after('diagnosis');
            $table->string('treatment_options_intro')->nullable()->after('treatment_options');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('condition_treateds', function (Blueprint $table) {
            $table->dropColumn(['symptoms_intro', 'causes_intro', 'diagnosis_intro', 'treatment_options_intro']);
        });
    }
};
