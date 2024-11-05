<?php

namespace App\Http\Controllers;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use App\Models\Order;
use Illuminate\Support\Facades\Validator;

class OrderProcessingController extends Controller
{
    // Phương thức để tạo đơn hàng mới
  public function store(Request $request)
{
	$request->validate([
		'user_id' => 'required|exists:users,id', // Đảm bảo user_id tồn tại trong bảng users
		'order_items' => 'required|array', // Đảm bảo order_items là mảng
		'amount' => 'required|numeric|min:0',
	]);

	$order = Order::create([
		'user_id' => $request->user_id,
		'amount' => $request->amount,
		'status' => 'pending', // Trạng thái mặc định
	]);
    $order->created_at = now(); 
    $order->save();

	// Lưu order_items
	foreach ($request->order_items as $item) {
		OrderItem::create([
			'order_id' => $order->id,
			'product_id' => $item['product_id'],
			'quantity' => $item['quantity'],
			'price' => $item['price'],
		]);
	}

	return response()->json(['message' => 'Order created successfully!', 'data' => $order], 201);
}



    // Phương thức để lấy thông tin đơn hàng theo ID
    public function show($id)
    {
        $order = Order::with('orderItems.product')->find($id); // Gọi chi tiết đơn hàng cùng với sản phẩm

        if (!$order) {
            return response()->json(['message' => 'Order not found!'], 404);
        }
        $order->created_at = $order->created_at->format('Y-m-d H:i:s'); 

        return response()->json($order, 200);
    }

    // Phương thức để hủy đơn hàng
    public function cancel($id)
    {
        $order = Order::find($id);

        if (!$order) {
            return response()->json(['message' => 'Order not found!'], 404);
        }

        if ($order->status !== 'pending') {
            return response()->json(['message' => 'Order cannot be cancelled!'], 400);
        }

        $order->status = 'cancelled';
        $order->save();

        return response()->json(['message' => 'Order cancelled successfully!'], 200);
    }
  public function storeOrderItems(Request $request)
{
    // Kiểm tra xem trường 'order_items' có tồn tại hay không
    if (!$request->has('order_items')) {
        return response()->json(['message' => 'The order items field is required.'], 400);
    }

    // Xác thực dữ liệu đầu vào
    $validatedData = $request->validate([
        'order_items' => 'required|array',
        'order_items.*.order_id' => 'required|integer|exists:orders,id',
        'order_items.*.product_id' => 'required|integer|exists:products,id',
        'order_items.*.quantity' => 'required|integer|min:1',
        'order_items.*.price' => 'required|numeric|min:0',
    ]);

    // Lưu order items vào database
    OrderItem::insert($validatedData['order_items']);

    return response()->json(['message' => 'Order items created successfully'], 201);
}
public function checkout(Request $request)
{
    $request->validate([
        'amount' => 'required|numeric',
        'user_id' => 'required|exists:users,id', // Kiểm tra user_id có tồn tại trong bảng users không
    ]);

    // Xử lý thanh toán ở đây
}
public function getPaymentHistory(Request $request)
    {
        // Thay thế bằng logic thực tế để lấy lịch sử thanh toán
        try {
            // Giả sử bạn muốn lấy tất cả các order items
            $paymentHistory = OrderItem::with('order', 'product')->get(); // Kết hợp với order và product

            return response()->json($paymentHistory); // Trả về dữ liệu dưới dạng JSON
        } catch (\Exception $e) {
            // Trả về lỗi nếu có
            return response()->json(['error' => 'Failed to fetch payment history: ' . $e->getMessage()], 500);
        }
    }


}
