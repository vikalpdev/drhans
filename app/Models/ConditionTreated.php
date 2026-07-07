<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ConditionTreated extends Model
{
    /** @use HasFactory<\Database\Factories\ConditionTreatedFactory> */
    use HasFactory;

    protected $fillable = [
        'name', 'slug', 'category', 'icon', 'summary', 'overview',
        'symptoms', 'causes', 'treatment_options', 'when_to_see_doctor', 'order',
    ];

    protected $casts = [
        'symptoms' => 'array',
        'causes' => 'array',
        'treatment_options' => 'array',
        'when_to_see_doctor' => 'array',
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
}
