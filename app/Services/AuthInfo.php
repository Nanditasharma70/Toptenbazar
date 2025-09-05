<?php

namespace App\Services;

use App\Models\Admin;
use App\Models\Role;
use Illuminate\Support\Facades\Auth;

class AuthInfo
{

    /**
     * @method Get User Role id
     * @param
     * @return roleId
     */
    public static function getUserRoleId()
    {
        return Auth::guard('web')->user()->role_id ?? '';
    }

    /**
     * @method Get User Role
     * @param
     * @return role
     */
    public static function getUserRole()
    {
        $roleId   =  Auth::user()->role_id;
        $role     =  Role::whereId($roleId)->select('name')->first();
        return !empty($role) ? strtolower($role->name) : '';
    }



    /**
     * @method Get User Id
     * @param
     * @return Id
     */
    public static function getUserId()
    {
        return Auth::guard('web')->user()->id ?? 1;
    }


    /**
     * @method Get User Name
     * @param
     * @return 
     */
    public static function getUserName()
    {
        return Auth::guard('web')->user()->name ?? '';
    }

    /**
     * @method Get User Status
     * @param
     * @return 
     */
    public static function getUserStatus()
    {
        return Auth::guard('web')->user()->status ?? '';
    }
}
