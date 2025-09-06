<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    protected $table = "addresses";
    protected $fillable = [
        'slug','user_id','address',
        'pincode','state','city','landmark'
    ];
}
