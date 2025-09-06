<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Variation extends Model
{
    protected $table = "variations";
    protected $fillable = ['deleted_at','deleted_by','updated_by','status','name','slug'];
}
