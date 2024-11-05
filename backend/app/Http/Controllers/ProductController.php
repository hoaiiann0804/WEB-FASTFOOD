<?php
namespace App\Http\Controllers;

use App\Models\Stock;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Requests\StoreProduct;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
class ProductController extends Controller
{
    public function index()
    {
        return Product::with("category", "stocks")->paginate(5);
    }

    public function show($id)
    {
        $product = Product::with("category", "stocks")->findOrFail($id);
        if ($product->reviews()->exists()) {
            $product['review'] = $product->reviews()->avg('rating');
            $product['num_reviews'] = $product->reviews()->count();
        }
        return $product;
    }





    // public function store(StoreProduct $request)
    // {
    //     if ($user = JWTAuth::parseToken()->authenticate()) {
    //         $validator = $request->validated();
    //         $data = null;
    //         if ($request->hasFile('photos')) {
    //             foreach ($request->file('photos') as $photo) {
    //                 $name = time() . '.' . $photo->getClientOriginalName();
    //                 $photo->move('img', $name);
    //                 $data[] = $name;
    //             }
    //         }
    //         $product = Product::create([
    //             'user_id' => $user->id,
    //             'category_id' => $request->category_id,
    //             'photo' => json_encode($data),
    //             'brand' => $request->brand,
    //             'name' => $request->name,
    //             'description' => $request->description,
    //             'details' => $request->details,
    //             'price' => $request->price,
    //         ]);
    //         Stock::create([
    //             'product_id' => $product->id,
    //             'size' => $request->size,
    //             'color' => $request->color,
    //             'quantity' => $request->quantity,
    //         ]);
    //     }
    // }
    public function store(StoreProduct $request)
{
    if ($user = JWTAuth::parseToken()->authenticate()) {
        $validator = $request->validated(); // Nếu StoreProduct đã xác thực, không cần kiểm tra lại

        // Kiểm tra xem có ảnh không
        if ($request->hasFile('photo')) {
            $photo = $request->file('photo');
            $name = time() . '.' . $photo->getClientOriginalName();
            $photo->move('img', $name);
        } else {
            return response()->json(['message' => 'The Photo field is required.'], 400); // Trả lỗi nếu không có ảnh
        }

        try {
            // Tạo sản phẩm mới
            $product = Product::create([
                'user_id' => $user->id,
                'category_id' => $request->category_id,
                'photo' => $name,
                'brand' => $request->brand,
                'name' => $request->name,
'description' => $request->description,
                'details' => $request->details,
                'price' => $request->price,
            ]);

            // Tạo thông tin kho
            Stock::create([
                'product_id' => $product->id,
                'size' => $request->size,
                'color' => $request->color,
                'quantity' => $request->quantity,
            ]);

            return response()->json(['product' => $product, 'message' => 'Product created successfully'], 201);
        } catch (\Exception $e) {
            \Log::error('Error creating product:', ['error' => $e->getMessage()]);
            return response()->json(['message' => 'Internal Server Error'], 500);
        }
    }

    return response()->json(['message' => 'Unauthorized'], 401);
}


    public function destroy($id)
    {
        if ($user = JWTAuth::parseToken()->authenticate()) {
            $product = Product::findOrFail($id);
            // return $product->photo;
            if ($product) {
                if ($product->photo != null) {
                    foreach (json_decode($product->photo) as $photo) {
                        unlink(public_path() . '\\img\\' . $photo);
                    }
                }
                $product->delete();
            }
        }
    }
}