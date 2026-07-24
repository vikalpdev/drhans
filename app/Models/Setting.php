<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $fillable = [
        'phone', 'whatsapp_number', 'email',
        'facebook_url', 'instagram_url', 'youtube_url', 'linkedin_url', 'x_url',
        'privacy_policy_url', 'terms_url', 'refund_policy_url',
    ];

    public static function current(): self
    {
        return static::query()->firstOrCreate(['id' => 1]);
    }

    public function whatsappUrl(): ?string
    {
        return $this->whatsapp_number ? 'https://wa.me/'.$this->whatsapp_number : null;
    }

    public function phoneUrl(): ?string
    {
        return $this->phone ? 'tel:'.$this->phone : null;
    }
}
