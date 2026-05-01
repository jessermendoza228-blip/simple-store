<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use App\Jobs\SendOrderConfirmationJob;

class CheckoutController extends Controller
{
    public function store(Request $request)
    {
        $cart = session()->get('cart');

        if (!$cart || count($cart) == 0) {
            return back()->with('error', 'Cart is empty.');
        }

        $total = 0;

        // ✅ Calculate total + stock check
        foreach ($cart as $productId => $item) {

            $product = Product::find($productId);

            if (!$product) {
                return back()->with('error', 'Product not found.');
            }

            if ($item['quantity'] > $product->stock) {
                return back()->with('error', 'Not enough stock for ' . $product->name);
            }

            $total += $product->price * $item['quantity'];
        }

        // 🧾 CREATE ORDER
        $order = Order::create([
            'user_id' => Auth::id(),
            'name'    => Auth::user()->name,
            'email'   => Auth::user()->email,
            'total'   => $total,
            'status'  => 'pending',
        ]);

        // 📦 SAVE ITEMS + REDUCE STOCK
        foreach ($cart as $productId => $item) {

            $product = Product::find($productId);

            OrderItem::create([
                'order_id'   => $order->id,
                'product_id' => $productId,
                'quantity'   => $item['quantity'],
                'price'      => $product->price,
            ]);

            $product->stock -= $item['quantity'];
            $product->save();
        }

        // 📧 MODULE 8: DISPATCH JOB (sends email via queue)
        SendOrderConfirmationJob::dispatch($order);

        // 🔁 GO TO PAYMENT
        return redirect()->route('payment.pay', $order);
    }

    public function success(Order $order)
    {
        session()->forget('cart');

        $order->update([
            'status' => 'paid'
        ]);

        return view('checkout.success', compact('order'));
    }
}