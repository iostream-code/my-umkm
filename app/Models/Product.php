<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Store;
use App\Model\Order;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'store_id',
        'name',
        'price',
        'description',
        'image',
        'stock',
    ];

    public function orders()
    {
        return $this->belongsToMany(Order::class);
    }

    public function carts()
    {
        return $this->hasMany(Order::class);
    }

    public function store()
    {
        return $this->belongsTo(Store::class);
    }
}
