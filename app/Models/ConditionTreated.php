<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class ConditionTreated extends Model implements HasMedia
{
    /** @use HasFactory<\Database\Factories\ConditionTreatedFactory> */
    use HasFactory, InteractsWithMedia;

    protected $fillable = [
        'name', 'slug', 'category', 'icon', 'summary', 'overview', 'meta_title', 'meta_description',
        'symptoms_intro', 'symptoms', 'causes_intro', 'causes', 'diagnosis_intro', 'diagnosis',
        'treatment_options_intro', 'treatment_options', 'prevention', 'why_choose_us',
        'when_to_see_doctor', 'faqs', 'order',
    ];

    protected $casts = [
        'symptoms' => 'array',
        'causes' => 'array',
        'diagnosis' => 'array',
        'treatment_options' => 'array',
        'when_to_see_doctor' => 'array',
        'faqs' => 'array',
    ];

    public const CATEGORIES = [
        'ear' => 'Ear (Otology)',
        'nose_sinus' => 'Nose & Sinus',
        'throat' => 'Voice & Throat',
        'vertigo_balance' => 'Vertigo & Balance',
        'tinnitus' => 'Tinnitus',
        'pediatric' => 'Paediatric ENT',
        'speech_disorders' => 'Speech Disorders',
        'head_neck' => 'Head & Neck',
    ];

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('hero_image')->singleFile();
    }

    public function registerMediaConversions(?Media $media = null): void
    {
        $this->addMediaConversion('thumb')->width(400)->height(300)->sharpen(10)->format('webp')->nonQueued();
        $this->addMediaConversion('hero')->width(1280)->height(720)->sharpen(10)->format('webp')->nonQueued();
    }
}
