<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class Store extends Model
{
    protected $fillable = [
        'user_id', 'name', 'slug', 'email', 'picture', 'location',
        'description', 'no_rek', 'bank',
    ];

    protected static function booted(): void
    {
        static::creating(function (Store $store) {
            $store->slug ??= static::uniqueSlug($store->name);
        });
    }

    public static function uniqueSlug(string $name): string
    {
        $base = Str::slug($name);
        $slug = $base;
        $i = 2;
        while (static::where('slug', $slug)->exists()) {
            $slug = "{$base}-{$i}";
            $i++;
        }
        return $slug;
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }

    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }

    public function getPictureUrlAttribute(): ?string
    {
        if (!$this->picture) {
            return null;
        }
        return str_starts_with($this->picture, 'http')
            ? $this->picture
            : asset('storage/' . $this->picture);
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }
}
