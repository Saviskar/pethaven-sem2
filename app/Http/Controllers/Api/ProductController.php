<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::with(['category', 'promotions']);

        if ($request->has('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        if ($request->has('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        $products = $query->paginate(10);

        return response()->json($products);
    }

    public function show($id)
    {
        $product = Product::with('category')->find($id);

        if (!$product) {
            return response()->json(['message' => 'Product not found'], 404);
        }

        $product->append(['active_promotion', 'discounted_price']);

        return response()->json(['data' => $product]);
    }

    public function offers()
    {
        $products = Product::whereHas('promotions', function ($query) {
            $query->where('status', true);
        })->with(['category', 'promotions'])->get();

        $products->each(function ($product) {
            $product->append(['active_promotion', 'discounted_price']);
        });

        return response()->json(['data' => $products]);
    }
}
