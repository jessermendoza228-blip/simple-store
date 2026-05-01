<?php

namespace App\Http\Controllers;

use App\Models\Product;

class ProductController extends Controller
{
    // GET /api/products
    public function index()
    {
        return response()->json([
            'products' => Product::all()
        ]);
    }

    // GET /api/products/{product}
    public function show(Product $product)
    {
        return response()->json([
            'product' => $product
        ]);
    }
}