<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\Review;

use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Category::all();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function new($id)
    {
        $products = Product::with('category')->where('category_id', $id)->orderBy('id', 'desc')->paginate(4);

        foreach($products as $product) {
            if($product->reviews()->exists()) {
                $product['review'] = $product->reviews()->avg('rating');
            }
        }
        return $products;
    }



    public function topSelling($id) {

        $products = Product::with('category')->where('category_id', $id)->take(6)->get();

        foreach($products as $product) {
            if($product->reviews()->exists())
                $product['review'] = $product->reviews()->avg('rating');

            if($product->stocks()->exists()) {
                $num_orders = 0;
                $stocks = $product->stocks()->get();
                foreach($stocks as $stock)
                    $num_orders += $stock->orders()->count();
                $product['num_orders'] = $num_orders;
            }  else {
                $product['num_orders'] = 0;
            }
        }
        return $products->sortByDesc('num_orders')->values()->all();
    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
    // Xác thực dữ liệu
    $request->validate([
        'name' => 'required|string|max:255',
    ]);

    // Sử dụng mass assignment để tạo danh mục mới
    $category = Category::create($request->all());

    return response()->json($category, 201);
}



    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
{
    // Tìm danh mục theo ID
    $category = Category::findOrFail($id);

    // Validate dữ liệu đầu vào
    $validatedData = $request->validate([
'name' => 'required|string|max:255',
    ]);

    // Cập nhật danh mục
    $category->update([
        'name' => $validatedData['name'],
    ]);

    // Trả về phản hồi thành công
    return response()->json([
        'message' => 'Category updated successfully',
        'category' => $category,
    ]);
}


    public function destroy($id)
    {
        $category = Category::find($id);

        if (!$category) {
            return response()->json(['message' => 'Category not found'], 404);
        }

        $category->delete();
        return response()->json(['message' => 'Category deleted successfully'], 200);
    }


}