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
        'practo_url', 'justdial_url', 'virtual_tour_url',
        'opd_weekday', 'opd_sunday', 'lat', 'lng', 'google_maps_url', 'facilities', 'order', 'is_active',
    ];

    protected $casts = [
        'facilities' => 'array',
        'lat' => 'decimal:7',
        'lng' => 'decimal:7',
        'is_active' => 'boolean',
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

    public function directionsUrl(): ?string
    {
        if ($this->google_maps_url) {
            return $this->google_maps_url;
        }

        if ($this->lat && $this->lng) {
            return "https://www.google.com/maps/dir/?api=1&destination={$this->lat},{$this->lng}";
        }

        return null;
    }

    public function virtualTourEmbedUrl(): ?string
    {
        if (! $this->virtual_tour_url) {
            return null;
        }

        if (preg_match('/(?:youtu\.be\/|youtube\.com\/(?:watch\?v=|embed\/))([a-zA-Z0-9_-]+)/', $this->virtual_tour_url, $matches)) {
            return 'https://www.youtube.com/embed/'.$matches[1];
        }

        return $this->virtual_tour_url;
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
