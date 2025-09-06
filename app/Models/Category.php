<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Category extends Model
{
    protected $table = "categories";
    protected $fillable = ["deleted_by",'updated_by','sub_category','sorting_priority_number','name','slug','description','status'];

    public function image():HasOne
    {
        return $this->hasOne(UploadedFile::class, 'cat_id','id');
    }
}
