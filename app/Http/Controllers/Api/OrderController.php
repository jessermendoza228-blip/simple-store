<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $orders = DB::table('orders')
            ->where('user_id', $request->user()->id)
            ->select('id', 'total', 'status', 'created_at')
            ->latest()
            ->limit(5)
            ->get();

        return response()->json($orders);
    }

    public function show(Request $request, $id)
    {
        $order = DB::table('orders')
            ->where('id', $id)
            ->where('user_id', $request->user()->id)
            ->select('id', 'total', 'status', 'created_at')
            ->first();

        if (!$order) {
            return response()->json(['message' => 'Forbidden'], 403);
        }

        return response()->json($order);
    }
}