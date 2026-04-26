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
            $total += $item['price'] * $item['quantity'];
        }

        return view('cart.index', compact('cart', 'total'));
    }

    public function add(Request $request, Product $product)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1',
        ]);

        $cart = session()->get('cart', []);
        $qty = $request->quantity;

        if (isset($cart[$product->id])) {
            $qty += $cart[$product->id]['quantity'];
        }

        if ($qty > $product->stock) {
            return back()->with('error', 'Not enough stock!');
        }

        $cart[$product->id] = [
            'product_id' => $product->id,
            'name' => $product->name,
            'price' => $product->price,
            'quantity' => $qty,
            'image' => $product->image,
        ];

        session()->put('cart', $cart);

        return back()->with('success', 'Added to cart!');
    }

    public function update(Request $request, $id)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            $cart[$id]['quantity'] = $request->quantity;
        }

        session()->put('cart', $cart);

        return back()->with('success', 'Cart updated!');
    }

    public function remove($id)
    {
        $cart = session()->get('cart', []);

        unset($cart[$id]);

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
                'total' => 0
            ]);

            $total = 0;

            foreach ($cart as $item) {

                if (!isset($item['product_id'])) {
                    continue;
                }

                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $item['product_id'],
                    'price' => $item['price'],
                    'quantity' => $item['quantity'],
                ]);

                $total += $item['price'] * $item['quantity'];
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