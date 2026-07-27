<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Testimonial extends Model
{
    protected $fillable = [
        'customer_name', 'customer_photo', 'city', 'rating', 'content',
        'product_id', 'is_active', 'sort_order',
    ];

    protected $casts = ['is_active' => 'boolean'];

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true)->orderBy('sort_order');
    }
}
