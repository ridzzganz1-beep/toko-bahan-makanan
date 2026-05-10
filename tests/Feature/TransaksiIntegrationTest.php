<?php

namespace Tests\Feature;

use App\Models\Barang;
use App\Models\Transaksi;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TransaksiIntegrationTest extends TestCase
{
    use RefreshDatabase;

    public function test_integration_toko()
    {
        $beras = Barang::create(['nama' => 'Beras', 'harga' => 12000]);
        $minyak = Barang::create(['nama' => 'Minyak Goreng', 'harga' => 18000]);

        $response = $this->post(route('transaksi.store'), [
            'pembeli' => 'Andi',
            'barangs' => [$beras->id, $minyak->id],
            'jumlah' => [
                $beras->id => 2,
                $minyak->id => 1,
            ],
        ]);

        $response->assertRedirect();

        $transaksi = Transaksi::first();
        $this->assertNotNull($transaksi);
        $this->assertEquals(42000, $transaksi->total);
        $this->assertStringContainsString('Beras', $transaksi->tampilkanStruk());
        $this->assertStringContainsString('Minyak Goreng', $transaksi->tampilkanStruk());

        $showResponse = $this->get(route('transaksi.show', $transaksi));
        $showResponse->assertStatus(200);
        $showResponse->assertSee('Total Belanja');
        $showResponse->assertSee('Beras');
        $showResponse->assertSee('Minyak Goreng');
    }
}
