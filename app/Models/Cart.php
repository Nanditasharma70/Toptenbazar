<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $table = "carts";
    protected $fillable = ['slug','customer_id','product_id','quantity','price','attributes'];
}
