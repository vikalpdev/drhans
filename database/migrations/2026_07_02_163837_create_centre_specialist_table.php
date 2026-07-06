<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('centre_specialist', function (Blueprint $table) {
            $table->foreignId('centre_id')->constrained()->cascadeOnDelete();
            $table->foreignId('specialist_id')->constrained()->cascadeOnDelete();
            $table->primary(['centre_id', 'specialist_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('centre_specialist');
    }
};
