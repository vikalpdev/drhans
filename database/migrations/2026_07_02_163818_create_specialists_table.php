<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('specialists', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->enum('type', ['ent_surgeon', 'audiologist', 'allied'])->default('ent_surgeon');
            $table->string('designation')->nullable();
            $table->string('qualifications')->nullable();
            $table->boolean('is_chairman')->default(false);
            $table->boolean('is_founder')->default(false);
            $table->unsignedInteger('experience_years')->default(0);
            $table->unsignedInteger('procedures_count')->nullable();
            $table->text('bio')->nullable();
            $table->json('expertise')->nullable();
            $table->json('interests')->nullable();
            $table->json('education')->nullable();
            $table->json('experience_timeline')->nullable();
            $table->text('quote')->nullable();
            $table->unsignedInteger('order')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('specialists');
    }
};
