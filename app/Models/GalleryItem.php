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

    protected $fillable = ['title', 'category_id', 'centre_id', 'order', 'is_active'];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function centre(): BelongsTo
    {
        return $this->belongsTo(Centre::class);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(GalleryCategory::class, 'category_id');
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
