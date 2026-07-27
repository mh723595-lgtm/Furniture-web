<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ShowroomImage extends Model
{
    protected $fillable = ['showroom_id', 'image_path', 'sort_order'];

    public function showroom(): BelongsTo
    {
        return $this->belongsTo(Showroom::class);
    }
}
