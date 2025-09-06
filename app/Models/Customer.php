<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
     protected $table = "customers";
    protected $fillable = ['password','mobile','email','name','slug','role_id','status'];
}
