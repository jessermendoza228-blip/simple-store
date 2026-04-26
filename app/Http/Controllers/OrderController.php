<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::with('items') // 🔥 load order items
            ->where('user_id', Auth::id())
            ->latest()
            ->get();

        return view('orders.index', compact('orders'));
    }

    public function show(Order $order)
    {
        if ($order->user_id !== Auth::id()) {
            abort(403);
        }

        return view('orders.show', compact('order'));
    }
    public function store(Request $request)
{
    // 1. Create the main Order first
    $order = Order::create([
        'user_id' => auth()->id(), // or whatever logic you use for users
        'total_price' => $this->calculateTotal(), // ensure this matches your logic
        'status' => 'pending',
    ]);

    // 2. Get the cart from session
    $cart = session()->get('cart', []);

    // 3. Loop and create OrderItems
    foreach ($cart as $id => $details) {
        OrderItem::create([
            'order_id'   => $order->id,
            'product_id' => $id,           // This 'id' comes from the cart array key
            'quantity'   => $details['quantity'],
            'price'      => $details['price'],
        ]);
    }

    // 4. Clear the cart after successful checkout
    session()->forget('cart');

    return response()->json(['message' => 'Order placed successfully!']);
}
}