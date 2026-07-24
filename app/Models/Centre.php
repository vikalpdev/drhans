<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Centre extends Model implements HasMedia
{
    /** @use HasFactory<\Database\Factories\CentreFactory> */
    use HasFactory, InteractsWithMedia;

    protected $fillable = [
        'name', 'slug', 'meta_title', 'meta_description', 'city', 'address', 'phone', 'phone_general_enquiry', 'phone_appointment',
        'opd_weekday', 'opd_sunday', 'lat', 'lng', 'facilities', 'order',
    ];

    protected $casts = [
        'facilities' => 'array',
        'lat' => 'decimal:7',
        'lng' => 'decimal:7',
    ];

    public function specialists(): BelongsToMany
    {
        return $this->belongsToMany(Specialist::class);
    }

    public function appointments(): HasMany
    {
        return $this->hasMany(Appointment::class);
    }

    public function galleryItems(): HasMany
    {
        return $this->hasMany(GalleryItem::class);
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('image')->singleFile();
    }

    public function registerMediaConversions(?Media $media = null): void
    {
        $this->addMediaConversion('thumb')->width(400)->height(300)->sharpen(10)->format('webp');
        $this->addMediaConversion('card')->width(640)->height(420)->sharpen(10)->format('webp');
        $this->addMediaConversion('hero')->width(1280)->height(720)->sharpen(10)->format('webp');
    }
}
