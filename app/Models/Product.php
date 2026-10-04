<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

class Product extends Model
{
    public const KATEGORI = [
        'Makanan', 'Minuman', 'Fashion', 'Kerajinan', 'Pertanian', 'Jasa', 'Lainnya',
    ];

    protected $fillable = [
        'store_id', 'name', 'slug', 'category', 'price', 'description', 'image', 'stock',
    ];

    protected static function booted(): void
    {
        static::creating(function (Product $product) {
            $product->slug ??= static::uniqueSlug($product->name);
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

    public function store(): BelongsTo
    {
        return $this->belongsTo(Store::class);
    }

    public function getImageUrlAttribute(): string
    {
        if (!$this->image) {
            return 'https://placehold.co/640x480/fff3e6/ea580c?text=' . urlencode($this->name);
        }
        return str_starts_with($this->image, 'http')
            ? $this->image
            : asset('storage/' . $this->image);
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }
}
