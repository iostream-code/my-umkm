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
        'name',
        'price',
        'description',
        'image',
        'stock',
    ];

    // public function stores()
    // {
    //     return $this->belongsToMany(Store::class);
    // }

    // public function orders()
    // {
    //     return $this->belongsToMany(Order::class);
    // }
}
