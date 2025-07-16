<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function store(Request $request)
    {
        \Log::info('Request to store order:', $request->all());

        $order = Order::create([
            'user_id' => $request->input('user_id'),
            'status'  => 'pending',
        ]);

        foreach ($request->input('items') as $item) {
            OrderItem::create([
                'order_id'   => $order->id,
                'product_id' => $item['product_id'],
                'quantity'   => $item['quantity'],
            ]);
        }

        return response()->json([
            'message' => 'Order placed successfully',
            'order'   => $order->load('items.product'),
        ], 201);
    }

 public function index()
{
    $query = Order::with(['items.product'])->orderBy('created_at', 'desc');

    // لو مش أدمن، رجّع الطلبات الخاصة بيه بس
    if (auth()->user()->role !== 'admin') {
        $query->where('user_id', auth()->id());
    }

    // 👇 هنا بنجيب البيانات فعليًا
    $orders = $query->get();

    // ✅ هنا نطبع في اللوج علشان نتاكد
    \Log::info('Orders fetched:', $orders->toArray());

    return response()->json($orders);
}


}
