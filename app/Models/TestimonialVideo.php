<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class TestimonialVideo extends Model implements HasMedia
{
    /** @use HasFactory<\Database\Factories\TestimonialVideoFactory> */
    use HasFactory, InteractsWithMedia;

    protected $fillable = ['patient_name', 'title', 'category_id', 'video_url', 'order', 'is_active'];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(GalleryCategory::class, 'category_id');
    }

    public function embedUrl(): string
    {
        $url = $this->video_url;

        if (preg_match('/(?:youtu\.be\/|youtube\.com\/(?:watch\?v=|embed\/))([a-zA-Z0-9_-]+)/', $url, $matches)) {
            return 'https://www.youtube.com/embed/'.$matches[1].'?autoplay=1';
        }

        if (preg_match('/vimeo\.com\/(\d+)/', $url, $matches)) {
            return 'https://player.vimeo.com/video/'.$matches[1].'?autoplay=1';
        }

        return $url;
    }

    public function youtubeId(): ?string
    {
        if (preg_match('/(?:youtu\.be\/|youtube\.com\/(?:watch\?v=|embed\/))([a-zA-Z0-9_-]+)/', $this->video_url, $matches)) {
            return $matches[1];
        }

        return null;
    }

    public function thumbnailUrl(): ?string
    {
        if ($media = $this->getFirstMediaUrl('thumbnail', 'thumb')) {
            return $media;
        }

        if ($id = $this->youtubeId()) {
            return "https://i.ytimg.com/vi/{$id}/hqdefault.jpg";
        }

        return null;
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('thumbnail')->singleFile();
    }

    public function registerMediaConversions(?Media $media = null): void
    {
        $this->addMediaConversion('thumb')->width(400)->height(300)->sharpen(10)->format('webp');
    }
}
