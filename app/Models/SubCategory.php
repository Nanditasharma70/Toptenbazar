<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{
    protected $table = "sub_categories";
    protected $fillable = ['deleted_at','deleted_by','updated_by','name','description','slug'];
}
