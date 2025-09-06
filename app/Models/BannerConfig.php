<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BannerConfig extends Model
{
    protected $table = 'banner_configs';
    protected $fillable = ['slug', 'name'];
}
