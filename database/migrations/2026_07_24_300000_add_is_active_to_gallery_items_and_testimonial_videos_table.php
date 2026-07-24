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
        Schema::table('gallery_items', function (Blueprint $table) {
            $table->boolean('is_active')->default(true)->after('order');
        });

        Schema::table('testimonial_videos', function (Blueprint $table) {
            $table->boolean('is_active')->default(true)->after('order');
        });

        Schema::table('gallery_categories', function (Blueprint $table) {
            $table->boolean('is_active')->default(true)->after('order');
        });

        Schema::table('centres', function (Blueprint $table) {
            $table->boolean('is_active')->default(true)->after('order');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('gallery_items', function (Blueprint $table) {
            $table->dropColumn('is_active');
        });

        Schema::table('testimonial_videos', function (Blueprint $table) {
            $table->dropColumn('is_active');
        });

        Schema::table('gallery_categories', function (Blueprint $table) {
            $table->dropColumn('is_active');
        });

        Schema::table('centres', function (Blueprint $table) {
            $table->dropColumn('is_active');
        });
    }
};
