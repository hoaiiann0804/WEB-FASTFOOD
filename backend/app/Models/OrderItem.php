<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory;

    // Các trường có thể điền dữ liệu
    protected $fillable = ['order_id', 'product_id', 'quantity', 'price', 'user_id'];  // Thêm user_id nếu cần

    // Quan hệ với Order
    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    // Quan hệ với Product
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    // Quan hệ với User (nếu có)
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
