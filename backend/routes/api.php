<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    DashboardController,
    UserController,
    UserAddressController,
    ProductController,
    ProductDealsController,
    ProductOrdersController,
    CategoryController,
    ProductShoppingCartController,
    ProductWishlistController,
    StockController,
    NewsLetterController,
    ReviewController,
    CheckoutController,
    VNPAYController,
    OrderController,
    OrderProcessingController,
    PaymentHistoryController,
    ProductAdminController
};

// Dashboard
Route::get('/dashboard', [DashboardController::class, 'index']);

// JWT Authentication
Route::get('/auth', [UserController::class, 'getAuthenticatedUser']);
Route::post('/register', [UserController::class, 'register']);
Route::post('/login', [UserController::class, 'login'])->name('login');

// Address
Route::prefix('user')->group(function () {
    Route::get('/default-address', [UserAddressController::class, 'show']);
    Route::post('/create-user-address', [UserAddressController::class, 'createUser']);
    Route::post('/address', [UserAddressController::class,  'store']);
});

// Product
Route::prefix('products')->group(function () {
    Route::get('/', [ProductController::class, 'index']);
    Route::get('/{id}', [ProductController::class, 'show']);
    Route::get('/hot-deal', [ProductDealsController::class, 'hotDeals']);
    Route::post('/', [ProductController::class, 'store']);
    Route::delete('/{id}', [ProductController::class, 'destroy']);
});


// Product Orders
Route::post('/stripe', [ProductOrdersController::class, 'stripePost']);
Route::post('/product/orders', [ProductOrdersController::class, 'store']);

// Product Categories
Route::prefix('product/categories')->group(function () {
    Route::get('/', [CategoryController::class, 'index']);
    Route::get('/{id}/top-selling', [CategoryController::class, 'topSelling']);
    Route::get('/{id}/new', [CategoryController::class, 'new']);
    Route::get('/{id}', [CategoryController::class, 'show']); // Thêm route để lấy chi tiết category
    Route::post('/', [CategoryController::class, 'store']);  // Thêm danh mục
    Route::put('/{id}', [CategoryController::class, 'update']); // Sửa danh mục
    Route::delete('/{id}', [CategoryController::class, 'destroy']); // Xóa danh mục
});
// Product Categories
// Product Categories
Route::get('/product/categories', 'App\Http\Controllers\CategoryController@index');
Route::get('/product/categories/{id}/top-selling', 'App\Http\Controllers\CategoryController@topSelling');
Route::get('/product/categories/{id}/new', 'App\Http\Controllers\CategoryController@new');
Route::post('/product/categories', 'App\Http\Controllers\CategoryController@store');
Route::put('/product/categories/{id}', [CategoryController::class, 'update']);
Route::delete('/product/categories/{id}', 'App\Http\Controllers\CategoryController@destroy');
// Product Shopping Cart
Route::prefix('product/cart-list')->group(function () {
    Route::get('/count', [ProductShoppingCartController::class, 'cartCount']);
    Route::get('/', [ProductShoppingCartController::class, 'index']);
    Route::post('/', [ProductShoppingCartController::class, 'store']);
    Route::post('/guest', [ProductShoppingCartController::class, 'guestCart']);
    Route::put('/{id}', [ProductShoppingCartController::class, 'update']);
    Route::delete('/{id}', [ProductShoppingCartController::class, 'destroy']);
});

// Product Wishlist
Route::prefix('product/wishlist')->group(function () {
    Route::get('/count', [ProductWishlistController::class, 'count']);
    Route::get('/', [ProductWishlistController::class, 'index']);
    Route::post('/', [ProductWishlistController::class, 'store']);
    Route::delete('/{id}', [ProductWishlistController::class, 'destroy']);
});

// Product Stocks
Route::get('/product/stocks/{id}', [StockController::class, 'show']);

// Newsletter
Route::post('/newsletter', [NewsLetterController::class, 'store']);

// Review
Route::post('/reviews', [ReviewController::class, 'store']);

// Payment
Route::post('/vnpay', [CheckoutController::class, 'online_checkout']);
Route::get('/vnpay/return', [VNPAYController::class, 'vnpay_return']);

//order

//order
Route::post('/checkout', [OrderProcessingController::class, 'store']);
Route::post('/order', [OrderProcessingController::class, 'store']);  // Tạo đơn hàng mới
Route::get('/order/{id}', [OrderProcessingController::class, 'show']);  // Lấy thông tin đơn hàng theo ID
Route::post('/order/{id}/cancel', [OrderProcessingController::class, 'cancel']);  // Hủy đơn hàng theo ID
Route::post('/order_items', [OrderProcessingController::class, 'storeOrderItems']);

//shoping cart
Route::delete('/cart/clear', [ProductShoppingCartController::class, 'clearCart']);

//history payment
// Route::get('/payment-history', [PaymentHistoryController::class, 'index'])->name('payment.history');
Route::get('/payment-history', [PaymentHistoryController::class, 'index']);
Route::post('/payment-history', [PaymentHistoryController::class, 'store'])->name('payment.history.store');

// Product AdminController
Route::post('/products', [ProductAdminController::class, 'store']);
Route::get('/products', [ProductAdminController::class, 'index']);
Route::put('product/{id}', [ProductAdminController::class, 'update']);
Route::patch('product/{id}', [ProductAdminController::class, 'update']);
Route::delete('/products/{id}', [ProductAdminController::class, 'destroy']);
Route::get('product/{id}', [ProductAdminController::class, 'show']);

//
