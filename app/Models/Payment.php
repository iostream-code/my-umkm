<?php

namespace App\Models;

use App\Models\Cart;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'is_transfer',
        'receiver',
        'address',
        'phone',
    ];

    public function transaction()
    {
        return $this->hasOne(Transaction::class);
    }
}
