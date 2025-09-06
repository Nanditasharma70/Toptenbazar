<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ImageConfig extends Model
{
    protected $table = 'image_configs';
    protected $fillable = [
        'slug',
        'type', // "banner", "product", "category"
        'width',
        'height',
    ];
}
