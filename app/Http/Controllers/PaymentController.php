<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class PaymentController extends Controller
{
    public function pay(Order $order)
    {
        // 🔒 security check
        if ($order->user_id !== Auth::id()) {
            abort(403);
        }

        $secretKey = config('services.xendit.secret_key');

        // 🚨 safety check (prevents null crash)
        if (!$secretKey) {
            return redirect()->route('checkout.success', ['order' => $order->id])
                ->with('error', 'Xendit API key missing.');
        }

        // 💳 CREATE XENDIT INVOICE
        $response = Http::withBasicAuth($secretKey, '')
            ->post('https://api.xendit.co/v2/invoices', [
                'external_id' => 'order-' . $order->id,
                'amount' => $order->total,
                'payer_email' => $order->email,
                'description' => 'Order #' . $order->id,
                'success_redirect_url' => route('payment.success', ['order' => $order->id]),
                'failure_redirect_url' => route('payment.failure', ['order' => $order->id]),
            ]);

      // ❌ API FAILED
if ($response->failed()) {
    return redirect()->route('checkout.success', ['order' => $order->id])
        ->with('error', 'Payment gateway error. Please try again.');
}

$invoiceUrl = $response->json()['invoice_url'] ?? null;

if (!$invoiceUrl) {
    return redirect()->route('checkout.success', ['order' => $order->id])
        ->with('error', 'Invalid payment response.');
}

        // 💾 SAVE URL
        $order->update([
            'payment_url' => $invoiceUrl
        ]);

        // 🔁 REDIRECT TO XENDIT
        return redirect($invoiceUrl);
    }

    // ✅ SUCCESS PAGE
    public function success(Order $order)
    {
        $order->update([
            'status' => 'paid',
            'payment_status' => 'paid'
        ]);

        session()->forget('cart');

        return view('checkout.success', compact('order'));
    }

    // ❌ FAILURE PAGE
    public function failure(Order $order)
    {
        return view('checkout.failed', compact('order'))
            ->with('error', 'Payment failed. Please try again.');
    }
}