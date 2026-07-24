<?php

use App\Models\GalleryCategory;
use App\Models\GalleryItem;
use App\Models\TestimonialVideo;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    private array $photoCategories = [
        'centres' => 'Our Centres',
        'facilities' => 'Facilities',
        'treatments' => 'Treatments',
        'events' => 'Events & Workshops',
        'patient_care' => 'Patient Care',
        'awards' => 'Awards & Recognition',
    ];

    private array $videoCategories = [
        'ear' => 'Ear (Otology)',
        'nose_sinus' => 'Nose & Sinus',
        'throat' => 'Voice & Throat',
        'vertigo_balance' => 'Vertigo & Balance',
        'tinnitus' => 'Tinnitus',
        'pediatric' => 'Paediatric ENT',
        'speech_disorders' => 'Speech Disorders',
        'head_neck' => 'Head & Neck',
    ];

    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('gallery_items', function (Blueprint $table) {
            $table->foreignId('category_id')->nullable()->after('category')->constrained('gallery_categories')->nullOnDelete();
        });

        Schema::table('testimonial_videos', function (Blueprint $table) {
            $table->foreignId('category_id')->nullable()->after('category')->constrained('gallery_categories')->nullOnDelete();
        });

        $photoCategoryIds = [];
        $order = 0;
        foreach ($this->photoCategories as $slug => $name) {
            $photoCategoryIds[$slug] = GalleryCategory::create([
                'type' => 'photo',
                'name' => $name,
                'slug' => $slug,
                'order' => $order++,
            ])->id;
        }

        $order = 0;
        $videoCategoryIds = [];
        foreach ($this->videoCategories as $slug => $name) {
            $videoCategoryIds[$slug] = GalleryCategory::create([
                'type' => 'video',
                'name' => $name,
                'slug' => $slug,
                'order' => $order++,
            ])->id;
        }

        GalleryItem::query()->whereNotNull('category')->get()->each(function (GalleryItem $item) use ($photoCategoryIds) {
            if (isset($photoCategoryIds[$item->category])) {
                $item->update(['category_id' => $photoCategoryIds[$item->category]]);
            }
        });

        TestimonialVideo::query()->whereNotNull('category')->get()->each(function (TestimonialVideo $video) use ($videoCategoryIds) {
            if (isset($videoCategoryIds[$video->category])) {
                $video->update(['category_id' => $videoCategoryIds[$video->category]]);
            }
        });

        Schema::table('gallery_items', function (Blueprint $table) {
            $table->dropColumn('category');
        });

        Schema::table('testimonial_videos', function (Blueprint $table) {
            $table->dropColumn('category');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('gallery_items', function (Blueprint $table) {
            $table->string('category')->nullable()->after('title');
        });

        Schema::table('testimonial_videos', function (Blueprint $table) {
            $table->string('category')->nullable()->after('title');
        });

        GalleryItem::query()->with('category')->get()->each(function (GalleryItem $item) {
            $item->update(['category' => $item->category?->slug]);
        });

        TestimonialVideo::query()->with('category')->get()->each(function (TestimonialVideo $video) {
            $video->update(['category' => $video->category?->slug]);
        });

        Schema::table('gallery_items', function (Blueprint $table) {
            $table->dropConstrainedForeignId('category_id');
        });

        Schema::table('testimonial_videos', function (Blueprint $table) {
            $table->dropConstrainedForeignId('category_id');
        });

        GalleryCategory::query()->delete();
    }
};
