<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Store;
use App\Model\Transaction;
use App\Model\Cart;

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

    public function store()
    {
        return $this->belongsTo(Store::class);
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }

    public function carts()
    {
        return $this->hasMany(Cart::class);
    }
}
