<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobOpening extends Model
{
    /** @use HasFactory<\Database\Factories\JobOpeningFactory> */
    use HasFactory;

    protected $fillable = [
        'title', 'department', 'type', 'location', 'description', 'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public const DEPARTMENTS = [
        'medical' => 'Medical',
        'nursing' => 'Nursing',
        'audiology' => 'Audiology',
        'administration' => 'Administration',
        'others' => 'Others',
    ];
}
