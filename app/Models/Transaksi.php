<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Model Transaksi menyimpan pelanggan, item pembelian, dan total belanja.
 * Method hitungTotal dan tampilkanStruk dibuat di model sesuai ketentuan.
 */
class Transaksi extends Model
{
    protected $fillable = [
        'pembeli',
        'items',
        'total',
    ];

    protected $casts = [
        'items' => 'array',
        'total' => 'double',
    ];

    public function hitungTotal(): float
    {
        if (empty($this->items)) {
            return 0;
        }

        return collect($this->items)
            ->sum(function (array $item) {
                return ($item['harga'] ?? 0) * ($item['jumlah'] ?? 0);
            });
    }

    public function tampilkanStruk(): string
    {
        $lines = [];
        $lines[] = '===== STRUK TOKO BAHAN MAKANAN =====';
        $lines[] = 'Nama Pembeli: ' . $this->pembeli;
        $lines[] = '-----------------------------------';

        foreach ($this->items as $item) {
            $subtotal = ($item['harga'] ?? 0) * ($item['jumlah'] ?? 0);
            $lines[] = sprintf('%s x %d = Rp %s', $item['nama'], $item['jumlah'], number_format($subtotal, 0, ',', '.'));
        }

        $lines[] = '-----------------------------------';
        $lines[] = 'Total Belanja: Rp ' . number_format($this->hitungTotal(), 0, ',', '.');
        $lines[] = '===================================';

        return implode(PHP_EOL, $lines);
    }
}
