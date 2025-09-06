<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ChargeConfig extends Model
{
    protected $table = "charge_configs";
    protected $fillable = ['is_default','status','name','slug'];
}
