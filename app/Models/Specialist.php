<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Specialist extends Model implements HasMedia
{
    /** @use HasFactory<\Database\Factories\SpecialistFactory> */
    use HasFactory, InteractsWithMedia;

    protected $fillable = [
        'name', 'slug', 'meta_title', 'meta_description', 'type_id', 'designation', 'qualifications',
        'is_active', 'is_chairman', 'is_founder', 'experience_years', 'procedures_count',
        'bio', 'expertise', 'interests', 'languages', 'education', 'experience_timeline',
        'quote', 'order',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'is_chairman' => 'boolean',
        'is_founder' => 'boolean',
        'expertise' => 'array',
        'interests' => 'array',
        'languages' => 'array',
        'education' => 'array',
        'experience_timeline' => 'array',
    ];

    public function centres(): BelongsToMany
    {
        return $this->belongsToMany(Centre::class);
    }

    public function type(): BelongsTo
    {
        return $this->belongsTo(SpecialistType::class, 'type_id');
    }

    public function appointments(): HasMany
    {
        return $this->hasMany(Appointment::class);
    }

    public function reviews(): HasMany
    {
        return $this->hasMany(SpecialistReview::class);
    }

    public function approvedReviews(): HasMany
    {
        return $this->reviews()->where('status', 'approved')->latest();
    }

    public function averageRating(): ?float
    {
        return $this->approvedReviews()->avg('rating');
    }

    public function reviewsCount(): int
    {
        return $this->approvedReviews()->count();
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('photo')->singleFile();
    }

    public function registerMediaConversions(?Media $media = null): void
    {
        $this->addMediaConversion('thumb')->width(300)->height(300)->sharpen(10)->format('webp');
        $this->addMediaConversion('card')->width(480)->height(560)->sharpen(10)->format('webp');
    }
}
