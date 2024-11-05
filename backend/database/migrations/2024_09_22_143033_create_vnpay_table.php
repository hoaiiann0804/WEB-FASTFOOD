<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVnpayTable extends Migration
{
    public function up()
    {
        Schema::create('vnpay', function (Blueprint $table) {
            $table->id();
            $table->decimal('vnp_Amount', 15, 2);
            $table->string('vnp_BankCode');
            $table->string('vnp_BankTranNo');
            $table->string('vnp_CardType');
            $table->string('vnp_OrderInfo');
            $table->string('vnp_PayDate');
            $table->string('vnp_ResponseCode');
            $table->string('vnp_TmnCode');
            $table->string('vnp_TransactionNo');
            $table->string('vnp_TransactionStatus');
            $table->string('vnp_TxnRef');
            $table->string('vnp_SecureHash');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('vnpay');
    }
}
