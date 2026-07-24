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
        DB::statement("ALTER TABLE appointments MODIFY status ENUM('new', 'confirmed', 'cancelled', 'junk') DEFAULT 'new'");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::table('appointments')->where('status', 'junk')->update(['status' => 'new']);

        DB::statement("ALTER TABLE appointments MODIFY status ENUM('new', 'confirmed', 'cancelled') DEFAULT 'new'");
    }
};
