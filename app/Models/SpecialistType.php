<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class SpecialistType extends Model
{
    protected $fillable = ['name', 'slug', 'is_active', 'order'];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function specialists(): HasMany
    {
        return $this->hasMany(Specialist::class, 'type_id');
    }
}
