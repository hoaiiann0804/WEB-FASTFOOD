<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class PaymentHistory extends Model
{
    protected $fillable = ['user_id', 'amount', 'payment_method', 'status'];
}