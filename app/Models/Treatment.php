<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Treatment extends Model implements HasMedia
{
    /** @use HasFactory<\Database\Factories\TreatmentFactory> */
    use HasFactory, InteractsWithMedia;

    protected $fillable = [
        'name', 'slug', 'meta_title', 'meta_description', 'icon', 'summary', 'overview', 'details',
        'services', 'process_steps', 'who_benefits', 'why_choose_us', 'faqs', 'order',
    ];

    protected $casts = [
        'services' => 'array',
        'process_steps' => 'array',
        'who_benefits' => 'array',
        'why_choose_us' => 'array',
        'faqs' => 'array',
    ];

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('hero_image')->singleFile();
    }

    public function registerMediaConversions(?Media $media = null): void
    {
        $this->addMediaConversion('thumb')->width(400)->height(300)->sharpen(10)->format('webp');
        $this->addMediaConversion('hero')->width(1280)->height(720)->sharpen(10)->format('webp');
    }
}
