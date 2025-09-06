<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    protected $table    = 'coupons';
    protected $fillable = ['deleted_by','updated_by','created_by','status','product_id','capping','min_order_amount','coupon_type','coupon_code','coupon_name','slug'];
}
