<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\PaymentHistory;
use App\Models\OrderItem;
class PaymentHistoryController extends Controller
{

    public function index()
    {
        try {
            // Thực hiện truy vấn để lấy các thông tin order_id, product_id, price, quantity, created_at
            $orders = OrderItem::select('id','order_id', 'product_id', 'price', 'quantity', 'created_at')
                ->orderBy('created_at', 'asc')
                ->get();

            // Trả về kết quả dưới dạng JSON
            return response()->json($orders);

        } catch (\Exception $e) {
            // Xử lý lỗi chung
            return response()->json(['error' => 'An error occurred'], 500);
        }
    }

    public function store(Request $request)
    {
        PaymentHistory::create([
            'amount' => $request->amount,
            'payment_method' => $request->payment_method,
            'status' => $request->status,
        ]);

        return redirect()->back()->with('success', 'Lịch sử thanh toán đã được lưu.');
    }
}