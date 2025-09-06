<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Product extends Model
{
    protected $table = "products";
    protected $fillable = ['unit_id','variation_id','discount_amount','discount_type','tag_id','price','subcat_id','categ_id','name','description','slug'];

    public function category():BelongsTo
    {
        return $this->belongsTo(Category::class,'categ_id');
    }

    public function variation():BelongsTo
    {
        return $this->belongsTo(Variation::class,'variation_id');
    }

    public function unit():BelongsTo
    {
        return $this->belongsTo(Unit::class,'unit_id');
    }

    public function productTag():BelongsTo
    {
        return $this->belongsTo(ProductTag::class,'tag_id');
    }
    
    public function subCat():BelongsTo
    {
        return $this->belongsTo(SubCategory::class,'subcat_id');
    }
}
