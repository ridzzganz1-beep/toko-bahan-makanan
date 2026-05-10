<?php

namespace Tests\Unit;

use App\Models\Transaksi;
use Tests\TestCase;

class TransaksiTest extends TestCase
{
    public function test_hitung_total_belanja()
    {
        $transaksi = new Transaksi([
            'pembeli' => 'Test User',
            'items' => [
                ['nama' => 'Beras', 'harga' => 12000, 'jumlah' => 2],
                ['nama' => 'Gula Pasir', 'harga' => 13000, 'jumlah' => 1],
            ],
        ]);

        $this->assertEquals(37000, $transaksi->hitungTotal());
    }
}
