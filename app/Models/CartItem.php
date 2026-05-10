<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CartItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'cart_id',
        'barang_id',
        'name',
        'price',
        'quantity',
    ];

    protected $casts = [
        'price' => 'double',
        'quantity' => 'integer',
    ];

    public function cart()
    {
        return $this->belongsTo(Cart::class);
    }

    public function barang()
    {
        return $this->belongsTo(Barang::class);
    }

    public function getSubtotalAttribute(): float
    {
        return $this->price * $this->quantity;
    }
}
