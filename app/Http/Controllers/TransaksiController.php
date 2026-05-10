<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Transaksi;
use Illuminate\Http\Request;

/**
 * Controller untuk alur transaksi pembelian dan struk.
 */
class TransaksiController extends Controller
{
    public function create()
    {
        $barangs = Barang::orderBy('nama')->get();

        return view('transaksi.create', compact('barangs'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'pembeli' => 'required|string|max:255',
            'barangs' => 'required|array|min:1',
            'barangs.*' => 'exists:barangs,id',
            'jumlah' => 'required|array',
        ]);

        $items = [];
        foreach ($validated['barangs'] as $barangId) {
            $barang = Barang::findOrFail($barangId);
            $jumlah = (int) ($request->input('jumlah.' . $barangId, 0));

            if ($jumlah <= 0) {
                return back()->withErrors(['jumlah.' . $barangId => 'Jumlah harus minimal 1.'])->withInput();
            }

            $items[] = [
                'barang_id' => $barang->id,
                'nama' => $barang->nama,
                'harga' => $barang->harga,
                'jumlah' => $jumlah,
                'subtotal' => $barang->harga * $jumlah,
            ];
        }

        $transaksi = Transaksi::create([
            'pembeli' => $validated['pembeli'],
            'items' => $items,
            'total' => collect($items)->sum('subtotal'),
        ]);

        return redirect()->route('transaksi.show', $transaksi->id)
            ->with('success', 'Transaksi berhasil dibuat.');
    }

    public function show(Transaksi $transaksi)
    {
        return view('transaksi.struk', compact('transaksi'));
    }
}
