<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    public function store(Request $request)
    {
        // ✅ Validate input
        $request->validate([
            'payment_method' => 'nullable|string|max:255',
        ]);

        $cart = session()->get('cart');

        // ❌ Empty cart check
        if (!$cart || count($cart) === 0) {
            return back()->with('error', 'Your cart is empty.');
        }

        $total = 0;

        // ✅ STEP 1: FULL VALIDATION FIRST (NO DB CHANGES YET)
        foreach ($cart as $productId => $item) {

            $product = Product::find($productId);

            if (!$product) {
                return back()->with('error', 'Product not found.');
            }

            if (!isset($item['quantity']) || $item['quantity'] < 1) {
                return back()->with('error', 'Invalid quantity for ' . $product->name);
            }

            if ($item['quantity'] > $product->stock) {
                return back()->with('error', 'Not enough stock for ' . $product->name);
            }

            // prevent price tampering
            if ($item['price'] != $product->price) {
                return back()->with('error', 'Price mismatch detected for ' . $product->name);
            }

            $total += $product->price * $item['quantity'];
        }

        // ✅ STEP 2: CREATE ORDER
        $order = Order::create([
            'user_id' => Auth::id(),
            'total' => $total,
            'status' => 'pending',
        ]);

        // ✅ STEP 3: SAVE ITEMS + DECREASE STOCK
        foreach ($cart as $productId => $item) {

            $product = Product::find($productId);

            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $productId,
                'quantity' => $item['quantity'],
                'price' => $product->price,
            ]);

            $product->stock -= $item['quantity'];
            $product->save();
        }

        // ✅ STEP 4: CLEAR CART
        session()->forget('cart');

        return redirect()->route('checkout.success', $order->id)
            ->with('success', 'Order placed successfully!');
    }

    public function success(Order $order)
    {
        return view('checkout.success', compact('order'));
    }
}