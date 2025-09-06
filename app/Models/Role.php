<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Role extends Model
{
    //
    protected $table = "roles";
    protected $fillable = ['id','slug','name','deleted_by','updated_by','added_by','status'];

    
}
