<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SpecialistReview extends Model
{
    protected $fillable = ['specialist_id', 'name', 'phone', 'rating', 'comment', 'status'];

    public function specialist(): BelongsTo
    {
        return $this->belongsTo(Specialist::class);
    }
}
