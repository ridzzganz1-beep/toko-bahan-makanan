<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderDetail;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $cart = auth()->user()->cart()->with('items.barang')->first();

        if (!$cart || $cart->items->isEmpty()) {
            return redirect()->route('products.index')->with('error', 'Keranjang Anda masih kosong.');
        }

        return view('user.checkout', compact('cart'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'recipient_name' => 'required|string|max:255',
            'address' => 'required|string|max:1000',
            'phone' => 'required|string|max:25',
            'payment_method' => 'required|in:Transfer Bank,COD,Dana,OVO,Gopay',
        ]);

        $cart = auth()->user()->cart()->with('items.barang')->first();

        if (!$cart || $cart->items->isEmpty()) {
            return redirect()->route('products.index')->with('error', 'Tidak ada barang dalam keranjang.');
        }

        $total = $cart->items->sum(fn ($item) => $item->subtotal);

        $order = Order::create([
            'user_id' => auth()->id(),
            'recipient_name' => $data['recipient_name'],
            'address' => $data['address'],
            'phone' => $data['phone'],
            'payment_method' => $data['payment_method'],
            'status' => 'Paid',
            'total' => $total,
        ]);

        foreach ($cart->items as $item) {
            $order->details()->create([
                'barang_id' => $item->barang_id,
                'name' => $item->name,
                'price' => $item->price,
                'quantity' => $item->quantity,
                'subtotal' => $item->subtotal,
            ]);
        }

        $cart->items()->delete();

        return redirect()->route('orders.receipt', $order)->with('success', 'Pembayaran berhasil. Struk pembelian Anda telah dibuat.');
    }
}
