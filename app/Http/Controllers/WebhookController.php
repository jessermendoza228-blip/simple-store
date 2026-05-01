<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class WebhookController extends Controller
{
    public function handle(Request $request)
    {
        $data = $request->all();

        $externalId = $data['external_id'] ?? null;

        if (!$externalId) {
            return response()->json(['message' => 'No external ID'], 400);
        }

        $orderId = str_replace('order-', '', $externalId);

        $order = Order::find($orderId);

        if (!$order) {
            return response()->json(['message' => 'Order not found'], 404);
        }

        // 💳 ONLY MARK PAID IF SUCCESS
        if (isset($data['status']) && $data['status'] === 'PAID') {

            $order->update([
                'status' => 'paid',
                'payment_status' => 'paid'
            ]);
        }

        return response()->json(['message' => 'Webhook received']);
    }
}