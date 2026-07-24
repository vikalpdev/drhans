<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Setting extends Model
{
    protected $fillable = [
        'phone', 'whatsapp_number', 'email',
        'facebook_url', 'instagram_url', 'youtube_url', 'linkedin_url', 'x_url', 'linktree_url',
        'privacy_policy_url', 'terms_url', 'refund_policy_url',
        'logo_path', 'favicon_path',
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

    public function logoUrl(): ?string
    {
        return $this->logo_path ? Storage::disk('public')->url($this->logo_path) : null;
    }

    public function faviconUrl(): ?string
    {
        return $this->favicon_path ? Storage::disk('public')->url($this->favicon_path) : null;
    }
}
