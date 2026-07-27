<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id', 'name', 'slug', 'description', 'specification',
        'material', 'dimension', 'color', 'price', 'discount_price',
        'stock', 'sku', 'status', 'is_featured', 'is_best_seller',
        'thumbnail', 'whatsapp_link', 'tiktok_url', 'views',
        'meta_title', 'meta_description', 'meta_keywords',
    ];

    protected $casts = [
        'is_featured' => 'boolean',
        'is_best_seller' => 'boolean',
        'price' => 'decimal:2',
        'discount_price' => 'decimal:2',
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function images(): HasMany
    {
        return $this->hasMany(ProductImage::class)->orderBy('sort_order');
    }

    public function galleries(): HasMany
    {
        return $this->hasMany(Gallery::class);
    }

    public function testimonials(): HasMany
    {
        return $this->hasMany(Testimonial::class);
    }

    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    public function scopeBestSeller($query)
    {
        return $query->where('is_best_seller', true);
    }

    public function getFinalPriceAttribute()
    {
        return $this->discount_price ?? $this->price;
    }

    public function getHasDiscountAttribute(): bool
    {
        return !is_null($this->discount_price) && $this->discount_price < $this->price;
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }
}
