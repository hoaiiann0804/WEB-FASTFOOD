<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductAdminController extends Controller
{
    public function index(Request $request)
{
    // Lấy tất cả sản phẩm với pagination
    $products = Product::with(['category', 'stocks'])
        ->paginate(5); // Thay đổi số lượng sản phẩm mỗi trang nếu cần

    // Tạo cấu trúc phản hồi
    return response()->json([
        'current_page' => $products->currentPage(),
        'data' => $products->items(),
        'first_page_url' => $products->url(1),
        'from' => $products->firstItem(),
        'last_page' => $products->lastPage(),
        'last_page_url' => $products->url($products->lastPage()),
        'links' => [
            'previous' => $products->previousPageUrl(),
            'next' => $products->nextPageUrl(),
        ],
        'next_page_url' => $products->nextPageUrl(),
        'path' => $products->path(),
        'per_page' => $products->perPage(),
        'prev_page_url' => $products->previousPageUrl(),
        'to' => $products->lastItem(),
        'total' => $products->total(),
    ]);
}

    public function store(Request $request)
    {
        // Validate the request
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|integer',
            'category_id' => 'required|integer',
            'deal_id' => 'nullable|integer',
            'photo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'brand' => 'required|string|max:191',
            'name' => 'required|string|max:191',
            'description' => 'required|string|max:191',
            'details' => 'required|string|max:191',
            'price' => 'required|numeric'
        ]);

        // If validation fails, return errors
        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        }

        // Handle the file upload
        $photoPath = null; // Initialize the variable to hold the photo path
        if ($request->hasFile('photo')) {
            $photo = $request->file('photo');
            $filename = time() . '.' . $photo->getClientOriginalExtension(); // Create a unique filename
            $photo->move(public_path('img'), $filename); // Move the photo to the public/img directory
            $photoPath = '' . $filename; // Save the relative path to the variable
        }

        // Create the product
        $product = Product::create([
            'user_id' => $request->user_id,
            'category_id' => $request->category_id,
            'deal_id' => $request->deal_id,
            'photo' => $photoPath, // Use the relative path for the photo
            'brand' => $request->brand,
            'name' => $request->name,
'description' => $request->description,
            'details' => $request->details,
            'price' => $request->price,
        ]);

        return response()->json(['message' => 'Product created successfully', 'product' => $product], 201);
    }
public function update(Request $request, $id)
{
    // Tìm sản phẩm theo ID
    $product = Product::findOrFail($id);

    // Xác thực dữ liệu
    $validator = Validator::make($request->all(), [
        'category_id' => 'sometimes|integer',
        'deal_id' => 'nullable|integer',
        'photo' => 'sometimes|image|mimes:jpeg,png,jpg,gif|max:2048',
        'brand' => 'sometimes|string|max:191',
        'name' => 'sometimes|string|max:191',
        'description' => 'sometimes|string|max:191',
        'details' => 'sometimes|string|max:191',
        'price' => 'sometimes|numeric',
    ]);

    // Nếu validation thất bại, trả về lỗi
    if ($validator->fails()) {
        return response()->json(['message' => 'Validation failed', 'errors' => $validator->errors()], 422);
    }

    // Kiểm tra và xử lý ảnh mới nếu có tải lên
    if ($request->hasFile('photo')) {
        // Xóa ảnh cũ nếu có
        if ($product->photo) {
            $oldPhotoPath = public_path('img/' . $product->photo);
            if (file_exists($oldPhotoPath)) {
                unlink($oldPhotoPath); // Xóa file cũ
            }
        }

        // Lưu ảnh mới
        $photo = $request->file('photo');
        $filename = time() . '.' . $photo->getClientOriginalExtension();
        $photo->move(public_path('img'), $filename);
        $product->photo = $filename; // Cập nhật đường dẫn ảnh mới
    }

    // Cập nhật các thuộc tính khác, giữ nguyên giá trị cũ nếu không có thay đổi
    $product->fill($request->only([
        'category_id',
        'deal_id',
        'brand',
        'name',
        'description',
        'details',
        'price',
    ]));

    // Lưu lại các thay đổi của sản phẩm
    try {
        $product->save(); // Cập nhật cơ sở dữ liệu
        return response()->json(['message' => 'Product updated successfully', 'product' => $product], 200);
    } catch (\Exception $e) {
        return response()->json(['message' => 'Failed to update product', 'error' => $e->getMessage()], 500);
    }
}








public function destroy($id)
{
    // Tìm sản phẩm theo ID
    $product = Product::findOrFail($id);
    $product->delete(); // Xóa sản phẩm

    return response()->json(['message' => 'Product deleted successfully'], 200);
}

public function show($id)
{
    // Find product by ID with related models, if any
    $product = Product::with(['category', 'stocks'])->findOrFail($id);

    // Return product data in JSON format
    return response()->json(['product' => $product], 200);
}

}