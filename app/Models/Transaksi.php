<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;

    protected $fillable = [
        'pembeli',
        'items',
        'total',
    ];

    protected $casts = [
        'items' => 'array',
    ];

    /*
    |--------------------------------------------------------------------------
    | Hitung Total Belanja
    |--------------------------------------------------------------------------
    */

    public function hitungTotal()
    {
        $total = 0;

        foreach ($this->items as $item) {

            $harga = $item['harga'];
            $jumlah = $item['jumlah'];

            $total += $harga * $jumlah;
        }

        return $total;
    }

    /*
    |--------------------------------------------------------------------------
    | Tampilkan Struk
    |--------------------------------------------------------------------------
    */

    public function tampilkanStruk()
    {
        $struk = "=== STRUK BELANJA ===\n";
        $struk .= "Pembeli: {$this->pembeli}\n\n";

        foreach ($this->items as $item) {

            $subtotal = $item['harga'] * $item['jumlah'];

            $struk .= $item['nama']
                . " x "
                . $item['jumlah']
                . " = Rp "
                . number_format($subtotal, 0, ',', '.')
                . "\n";
        }

        $struk .= "\nTOTAL: Rp "
            . number_format($this->hitungTotal(), 0, ',', '.');

        return $struk;
    }
}