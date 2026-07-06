<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('condition_treateds', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->enum('category', [
                'ear', 'nose_sinus', 'throat', 'head_neck',
                'hearing_balance', 'pediatric', 'sleep', 'allergy',
            ]);
            $table->string('icon')->nullable();
            $table->string('summary');
            $table->text('overview')->nullable();
            $table->json('symptoms')->nullable();
            $table->json('causes')->nullable();
            $table->json('treatment_options')->nullable();
            $table->json('when_to_see_doctor')->nullable();
            $table->unsignedInteger('order')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('condition_treateds');
    }
};
