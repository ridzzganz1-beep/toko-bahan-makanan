<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Transaksi;
use Illuminate\Http\Request;

class TransaksiController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Form Transaksi
    |--------------------------------------------------------------------------
    */

    public function create()
    {
        $barangs = Barang::orderBy('nama')->get();

        return view('transaksi.create', compact('barangs'));
    }

    /*
    |--------------------------------------------------------------------------
    | Simpan Transaksi
    |--------------------------------------------------------------------------
    */

    public function store(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'pembeli' => 'required|string|max:255',
            'barangs' => 'required|array|min:1',
            'jumlah' => 'required|array',
        ]);

        $items = [];
        $total = 0;

        // Loop barang yang dipilih
        foreach ($validated['barangs'] as $barangId) {

            $barang = Barang::findOrFail($barangId);

            // Ambil jumlah barang
            $jumlah = (int) ($validated['jumlah'][$barangId] ?? 0);

            // Validasi jumlah tidak boleh negatif / nol
            if ($jumlah <= 0) {

                return back()
                    ->withErrors([
                        'jumlah' => 'Jumlah harus lebih dari 0'
                    ])
                    ->withInput();
            }

            // Hitung subtotal
            $subtotal = $barang->harga * $jumlah;

            // Simpan item
            $items[] = [
                'barang_id' => $barang->id,
                'nama' => $barang->nama,
                'harga' => $barang->harga,
                'jumlah' => $jumlah,
                'subtotal' => $subtotal,
            ];

            // Tambahkan ke total
            $total += $subtotal;
        }

        // Simpan transaksi ke database
        $transaksi = Transaksi::create([
            'pembeli' => $validated['pembeli'],
            'items' => $items,
            'total' => $total,
        ]);

        // Redirect ke halaman struk
        return redirect()
            ->route('transaksi.show', $transaksi->id)
            ->with('success', 'Transaksi berhasil dibuat.');
    }

    /*
    |--------------------------------------------------------------------------
    | Tampilkan Struk
    |--------------------------------------------------------------------------
    */

    public function show(Transaksi $transaksi)
    {
        return view('transaksi.struk', compact('transaksi'));
    }
}