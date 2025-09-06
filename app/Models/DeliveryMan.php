<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DeliveryMan extends Model
{
    protected $table = "delivery_men";
    // protected $guraded = [];
    protected $fillable = ['password','mobile','email','name','slug','role_id'];
}
