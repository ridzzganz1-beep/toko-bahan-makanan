<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\CartItem;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $cart = auth()->user()->cart()->with('items.barang')->first();

        return view('user.cart', compact('cart'));
    }

    public function add(Barang $barang)
    {
        $cart = auth()->user()->cart()->firstOrCreate([]);

        $item = $cart->items()->where('barang_id', $barang->id)->first();

        if ($item) {
            $item->update([
                'quantity' => $item->quantity + 1,
                'price' => $barang->harga,
                'name' => $barang->nama,
            ]);
        } else {
            $cart->items()->create([
                'barang_id' => $barang->id,
                'name' => $barang->nama,
                'price' => $barang->harga,
                'quantity' => 1,
            ]);
        }

        return redirect()->route('cart.index')->with('success', 'Barang berhasil ditambahkan ke keranjang.');
    }

    public function update(Request $request, CartItem $item)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1',
        ]);

        $cart = auth()->user()->cart;

        if (!$cart || $item->cart_id !== $cart->id) {
            abort(403);
        }

        $item->update([
            'quantity' => $request->quantity,
            'price' => $item->barang?->harga ?? $item->price,
            'name' => $item->barang?->nama ?? $item->name,
        ]);

        return back()->with('success', 'Jumlah keranjang berhasil diperbarui.');
    }

    public function destroy(CartItem $item)
    {
        $cart = auth()->user()->cart;

        if (!$cart || $item->cart_id !== $cart->id) {
            abort(403);
        }

        $item->delete();

        return back()->with('success', 'Barang berhasil dihapus dari keranjang.');
    }
}
