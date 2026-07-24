<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('specialists', function (Blueprint $table) {
            $table->boolean('available_morning')->default(true)->after('order');
            $table->boolean('available_afternoon')->default(true)->after('available_morning');
            $table->boolean('available_evening')->default(true)->after('available_afternoon');
        });
    }

    public function down(): void
    {
        Schema::table('specialists', function (Blueprint $table) {
            $table->dropColumn(['available_morning', 'available_afternoon', 'available_evening']);
        });
    }
};
