<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ContactSubmission extends Model
{
    /** @use HasFactory<\Database\Factories\ContactSubmissionFactory> */
    use HasFactory;

    protected $fillable = [
        'name', 'phone', 'email', 'centre_id', 'subject',
        'message', 'preferred_date', 'is_read',
    ];

    protected $casts = [
        'preferred_date' => 'date',
        'is_read' => 'boolean',
    ];

    public function centre(): BelongsTo
    {
        return $this->belongsTo(Centre::class);
    }
}
