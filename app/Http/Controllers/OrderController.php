<?php

namespace App\Http\Controllers;

use App\Models\Order;

class OrderController extends Controller
{
    public function index()
    {
        $orders = auth()->user()->orders()->latest()->paginate(10);

        return view('user.orders.index', compact('orders'));
    }

    public function show(Order $order)
    {
        if ($order->user_id !== auth()->id()) {
            abort(403);
        }

        return view('user.orders.show', compact('order'));
    }

    public function receipt(Order $order)
    {
        if ($order->user_id !== auth()->id()) {
            abort(403);
        }

        return view('user.orders.receipt', compact('order'));
    }
}
