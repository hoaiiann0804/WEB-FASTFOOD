<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentsTable extends Migration
{
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id'); // ID người dùng
            $table->decimal('amount', 10, 2); // Số tiền thanh toán
            $table->string('payment_method'); // Phương thức thanh toán (VD: VNPay, PayPal)
            $table->string('status')->default('pending'); // Trạng thái thanh toán (pending, completed)
            $table->timestamps();

            // Thiết lập khóa ngoại với bảng users
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('payments');
    }
}
