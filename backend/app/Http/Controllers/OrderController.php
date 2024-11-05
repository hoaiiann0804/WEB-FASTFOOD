<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function store(Request $request)
    {
        $user_id = $request->input('user_id');
        $items = $request->input('items');

        foreach ($items as $item) {
            Order::create([
                'user_id' => $user_id,
                'stock_id' => $item['stock_id'],
                'quantity' => $item['quantity'],
            ]);
        }

        return response()->json(['message' => 'Order created successfully']);
    }
}

