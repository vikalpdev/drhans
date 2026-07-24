<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class GalleryCategory extends Model
{
    use HasFactory;

    protected $fillable = ['type', 'name', 'slug', 'order', 'is_active'];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public const TYPES = [
        'photo' => 'Photo Gallery',
        'video' => 'Video Gallery',
    ];

    public function galleryItems(): HasMany
    {
        return $this->hasMany(GalleryItem::class, 'category_id');
    }

    public function testimonialVideos(): HasMany
    {
        return $this->hasMany(TestimonialVideo::class, 'category_id');
    }
}
