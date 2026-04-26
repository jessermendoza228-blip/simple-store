<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;

class OrderController extends Controller
{
    // SHOW ALL ORDERS
    public function index()
    {
        $orders = Order::with('orderItems.product')
            ->latest()
            ->get();

        return view('admin.orders.index', compact('orders'));
    }

    // SHOW SINGLE ORDER
    public function show(Order $order)
    {
        $order->load('orderItems.product');

        return view('admin.orders.show', compact('order'));
    }

    // UPDATE ORDER STATUS (FIXED)
    public function update(Request $request, Order $order)
    {
        $request->validate([
            'status' => 'required|string'
        ]);

        $order->status = $request->status;
        $order->save();

        return redirect()->back()
            ->with('success', 'Order updated successfully!');
    }
}