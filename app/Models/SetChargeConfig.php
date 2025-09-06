<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SetChargeConfig extends Model
{
    protected $table = 'set_charge_configs';
    protected $fillable = ['maximum_amount','minimum_amount','slab_applicable','capping','rate','caculation_type','charge_type','name'];
}
