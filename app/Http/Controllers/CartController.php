<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index()
    {
        $cart = session()->get('cart', []);
        $total = 0;

        foreach ($cart as $item) {
            $total += ($item['price'] ?? 0) * ($item['quantity'] ?? 0);
        }

        return view('cart.index', compact('cart', 'total'));
    }

    public function add(Request $request, Product $product)
    {
        // FIX: allow default quantity = 1 if not sent
        $qty = $request->quantity ?? 1;

        $cart = session()->get('cart', []);

        $existingQty = $cart[$product->id]['quantity'] ?? 0;
        $newQty = $existingQty + $qty;

        // STOCK CHECK
        if ($newQty > $product->stock) {
            return back()->with('error', 'Not enough stock!');
        }

        $cart[$product->id] = [
            'product_id' => $product->id,
            'name' => $product->name,
            'price' => $product->price,
            'quantity' => $newQty,
            'image' => $product->image ?? null,
        ];

        session()->put('cart', $cart);

        return back()->with('success', 'Added to cart!');
    }

    public function update(Request $request, $id)
    {
        $cart = session()->get('cart', []);

        if (!isset($cart[$id])) {
            return back()->with('error', 'Item not found in cart.');
        }

        $quantity = max(1, (int) $request->quantity);

        $product = Product::find($id);

        if ($product && $quantity > $product->stock) {
            return back()->with('error', 'Not enough stock!');
        }

        $cart[$id]['quantity'] = $quantity;

        session()->put('cart', $cart);

        return back()->with('success', 'Cart updated!');
    }

    public function remove($id)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            unset($cart[$id]);
        }

        session()->put('cart', $cart);

        return back()->with('success', 'Item removed!');
    }

    public function clear()
    {
        session()->forget('cart');

        return back()->with('success', 'Cart cleared!');
    }

    public function checkout()
    {
        try {
            $cart = session()->get('cart', []);

            if (empty($cart)) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Cart is empty'
                ]);
            }

            $order = Order::create([
                'user_id' => Auth::id(),
                'total' => 0,
                'status' => 'pending'
            ]);

            $total = 0;

            foreach ($cart as $item) {

                if (!isset($item['product_id'])) continue;

                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $item['product_id'],
                    'price' => $item['price'],
                    'quantity' => $item['quantity'],
                ]);

                $total += $item['price'] * $item['quantity'];

                // ✅ DECREMENT STOCK (IMPORTANT FOR YOUR REQUIREMENT)
                $product = Product::find($item['product_id']);
                if ($product) {
                    $product->stock -= $item['quantity'];
                    $product->save();
                }
            }

            $order->update(['total' => $total]);

            session()->forget('cart');

            return response()->json([
                'status' => 'success',
                'message' => 'Order placed successfully!'
            ]);

        } catch (\Throwable $e) {

            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ]);
        }
    }
}