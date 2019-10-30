<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Order;

class OrderController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\ProductRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $productId = $request->product_id;
        $product = Product::findOrFail($productId);

        $orderData = [
            'user_id' => auth()->id(),
            'total_price' => $product->price,
            'description' => 'xxx',
        ];


        try {
            $order = Order::create($orderData);
            $product->orders()->attach($order->id, ['quantity' => 1, 'price' => $product->price]);
        } catch (\Exception $e) {
            \Log::error($e);

            $result = [
                'status' => false,
                'quantity' => 0,
            ];

            return response()->json($result);
        }

        $result = [
            'status' => true,
            'quantity' => $order->products->count(),
        ];

        return response()->json($result);
    }
}
