<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('cms_pages', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->string('meta_title')->nullable();
            $table->string('meta_description')->nullable();
            $table->longText('body')->nullable();
            $table->timestamps();
        });

        DB::table('cms_pages')->insert([
            [
                'title' => 'Privacy Policy',
                'slug' => 'privacy-policy',
                'body' => '<p>Add your privacy policy content here.</p>',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Terms & Conditions',
                'slug' => 'terms-and-conditions',
                'body' => '<p>Add your terms &amp; conditions content here.</p>',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Refund Policy',
                'slug' => 'refund-policy',
                'body' => '<p>Add your refund policy content here.</p>',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cms_pages');
    }
};
