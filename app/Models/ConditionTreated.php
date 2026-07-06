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
        'ear' => 'Ear Conditions',
        'nose_sinus' => 'Nose & Sinus Conditions',
        'throat' => 'Throat Conditions',
        'head_neck' => 'Head & Neck Conditions',
        'hearing_balance' => 'Hearing & Balance Disorders',
        'pediatric' => 'Pediatric ENT Conditions',
        'sleep' => 'Sleep Related Conditions',
        'allergy' => 'Allergy & Immunology',
    ];
}
