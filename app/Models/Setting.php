<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class Setting extends Model
{
    protected $fillable = ['key', 'value', 'type', 'group'];

    public static function get(string $key, $default = null)
    {
        $settings = Cache::rememberForever('app_settings', function () {
            return static::query()
                ->pluck('value', 'key')
                ->toArray();
        });

        return $settings[$key] ?? $default;
    }
    protected static function booted(): void
    {
        static::saved(fn() => Cache::forget('app_settings'));
        static::deleted(fn() => Cache::forget('app_settings'));
    }
}
