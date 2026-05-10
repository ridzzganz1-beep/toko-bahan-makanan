<?php

namespace Tests\Unit;

use App\Models\Barang;
use Tests\TestCase;

class BarangTest extends TestCase
{
    public function test_input_barang()
    {
        $barang = Barang::make(['nama' => 'Tepung', 'harga' => 9000]);

        $this->assertEquals('Tepung', $barang->nama);
        $this->assertEquals(9000, $barang->harga);
    }

    public function test_input_barang_harga_negatif_gagal()
    {
        $this->expectException(\InvalidArgumentException::class);

        Barang::create(['nama' => 'Gula', 'harga' => -5000]);
    }
}
