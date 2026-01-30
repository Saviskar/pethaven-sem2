<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $orders = Order::where('user_id', $request->user()->id)
            ->with(['items.product'])
            ->latest('placed_at')
            ->get();

        return response()->json(['data' => $orders]);
    }

    public function show(Request $request, $id)
    {
        $order = Order::where('user_id', $request->user()->id)
            ->where('id', $id)
            ->with(['items.product'])
            ->firstOrFail();

        return response()->json(['data' => $order]);
    }

    public function store(Request $request)
    {
        // Place order from Cart
        $cart = Cart::where('user_id', $request->user()->id)->with('items.product')->first();

        if (!$cart || $cart->items->isEmpty()) {
            return response()->json(['message' => 'Cart is empty'], 400);
        }

        return DB::transaction(function () use ($request, $cart) {
            $order = Order::create([
                'user_id' => $request->user()->id,
                'placed_at' => now(),
                'status' => 'processing',
            ]);

            foreach ($cart->items as $item) {
                // Check stock
                if ($item->product->stock < $item->quantity) {
                    throw new \Exception("Product {$item->product->name} is out of stock (Requested: {$item->quantity}, Available: {$item->product->stock})");
                }
                
                // Deduct stock
                $item->product->decrement('stock', $item->quantity);

                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $item->product_id,
                    'quantity' => $item->quantity,
                    'unit_price_at_order' => $item->product->price,
                ]);
            }

            // Clear Cart
            $cart->items()->delete();

            return response()->json([
                'message' => 'Order placed successfully',
                'data' => $order
            ], 201);
        });
    }
}
