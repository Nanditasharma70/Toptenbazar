<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class CategorySubCategory extends Model
{
    //
    protected $table = "category_sub_categories";
    protected $fillable = ["sub_category_id","category_id"];

    public function subCategory():HasOne
    {
        return $this->hasOne(SubCategory::class,'id','sub_category_id');
    }
}
