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
            $table->json('diagnosis')->nullable()->after('causes');
            $table->longText('prevention')->nullable()->after('treatment_options');
            $table->json('faqs')->nullable()->after('when_to_see_doctor');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('condition_treateds', function (Blueprint $table) {
            $table->dropColumn(['diagnosis', 'prevention', 'faqs']);
        });
    }
};
