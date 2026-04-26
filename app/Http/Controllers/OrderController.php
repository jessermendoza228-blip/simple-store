<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    // SHOW ALL ORDERS (EXCLUDE CANCELLED)
    public function index()
    {
        $orders = Order::with('orderItems.product')
            ->where('user_id', auth()->id())
            ->where('status', '!=', 'cancelled')
            ->latest()
            ->get();

        return view('orders.index', compact('orders'));
    }

    // SHOW SINGLE ORDER
    public function show(Order $order)
    {
        if ($order->user_id !== auth()->id()) {
            abort(403);
        }

        $order->load('orderItems.product');

        return view('orders.show', compact('order'));
    }

    // STORE ORDER (CHECKOUT)
    public function store(Request $request)
    {
        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect()->route('cart.index')
                ->with('error', 'Cart is empty!');
        }

        // TOTAL CALCULATION
        $total = 0;

        foreach ($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }

        // CREATE ORDER
        $order = Order::create([
            'user_id' => auth()->id(),
            'total' => $total,
            'status' => 'pending',
        ]);

        // CREATE ORDER ITEMS + STOCK UPDATE
        foreach ($cart as $productId => $details) {

            $product = Product::find($productId);

            if ($product) {

                // STOCK CHECK
                if ($product->stock < $details['quantity']) {
                    return back()->with('error', 'Not enough stock for ' . $product->name);
                }

                // SAVE ORDER ITEM
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $productId,
                    'quantity' => $details['quantity'],
                    'price' => $details['price'],
                ]);

                // DECREASE STOCK
                $product->stock -= $details['quantity'];
                $product->save();
            }
        }

        // CLEAR CART
        session()->forget('cart');

        return redirect()->route('orders.index')
            ->with('success', 'Order placed successfully!');
    }

    // CANCEL ORDER
    public function cancel(Request $request, Order $order)
    {
        if ($order->user_id !== auth()->id()) {
            abort(403);
        }

        if ($order->status === 'cancelled') {
            return back()->with('error', 'Order already cancelled.');
        }

        $request->validate([
            'cancel_reason' => 'required|string|max:255',
        ]);

        $order->update([
            'status' => 'cancelled',
            'cancel_reason' => $request->cancel_reason,
            'cancelled_at' => now(),
        ]);

        return back()->with('success', 'Order cancelled successfully.');
    }
}