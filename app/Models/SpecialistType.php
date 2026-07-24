<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class SpecialistType extends Model
{
    protected $fillable = ['name', 'slug', 'order'];

    public function specialists(): HasMany
    {
        return $this->hasMany(Specialist::class, 'type_id');
    }
}
