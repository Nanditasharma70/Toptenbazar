<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    protected $table = "order_items";
    protected $fillable = ['slug','order_id','product_id','product_name','price','discount','quantity','total','deleted_at'];
}
