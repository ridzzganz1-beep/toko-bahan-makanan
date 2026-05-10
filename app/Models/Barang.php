<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Model Barang menyimpan data nama dan harga barang.
 * Validasi harga negatif dilakukan sebelum menyimpan.
 */
class Barang extends Model
{
    protected $fillable = [
        'nama',
        'harga',
        'stok',
        'gambar',
    ];

    protected static function booted()
    {
        static::saving(function (Barang $barang) {
            if ($barang->harga < 0) {
                throw new \InvalidArgumentException('Harga barang tidak boleh negatif.');
            }
        });
    }
}
