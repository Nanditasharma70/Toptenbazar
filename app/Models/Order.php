<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = "orders";
    protected $fillable = [
            'slug',
            'order_id','customer_id','total_items',
            'address_id','payment_method','payment_status',
            'total_amount','discount','final_amount',
            'delivery_man_id','delivery_fee','status','cancel_reason','cancelled_at',
            'deleted_at','delivered_at','shipped_at','paid_at'
    ];
}
