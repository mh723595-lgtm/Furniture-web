<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Showroom extends Model
{
    protected $fillable = [
        'name', 'slug', 'address', 'city', 'province', 'postal_code',
        'whatsapp_number', 'phone_number', 'email', 'operational_hours',
        'thumbnail', 'gmaps_embed', 'gmaps_url', 'latitude', 'longitude', 'is_active',
    ];

    protected $casts = ['is_active' => 'boolean'];

    public function images(): HasMany
    {
        return $this->hasMany(ShowroomImage::class)->orderBy('sort_order');
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function getWhatsappUrlAttribute(): string
    {
        $number = preg_replace('/\D/', '', $this->whatsapp_number);
        return "https://wa.me/{$number}";
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }
}
