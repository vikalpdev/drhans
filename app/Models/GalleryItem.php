<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class GalleryItem extends Model implements HasMedia
{
    /** @use HasFactory<\Database\Factories\GalleryItemFactory> */
    use HasFactory, InteractsWithMedia;

    protected $fillable = ['title', 'category', 'centre_id', 'order'];

    public const CATEGORIES = [
        'centres' => 'Our Centres',
        'facilities' => 'Facilities',
        'treatments' => 'Treatments',
        'events' => 'Events & Workshops',
        'patient_care' => 'Patient Care',
        'awards' => 'Awards & Recognition',
    ];

    public function centre(): BelongsTo
    {
        return $this->belongsTo(Centre::class);
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('image')->singleFile();
    }

    public function registerMediaConversions(?Media $media = null): void
    {
        $this->addMediaConversion('thumb')->width(400)->height(300)->sharpen(10)->format('webp');
    }
}
