<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'barang_id',
        'name',
        'price',
        'quantity',
        'subtotal',
    ];

    protected $casts = [
        'price' => 'double',
        'quantity' => 'integer',
        'subtotal' => 'double',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function barang()
    {
        return $this->belongsTo(Barang::class);
    }
}
