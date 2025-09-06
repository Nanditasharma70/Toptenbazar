<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UploadedFile extends Model
{
    use SoftDeletes;
    protected $table = "uploaded_files";
    protected $fillable = ['deleted_by','updated_by','path','mime_type','original_name','original_name','file_name','cat_id','subcat_id','user_id','deleted_at','product_id','delivery_man_id','banner_config_id']; 
}
