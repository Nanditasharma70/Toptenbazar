<?php

namespace App\Http\Middleware;

use App\Models\Role;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleCheck
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next, string $roleName)
    {
        $role = Role::where('name', $roleName)->first();

        if (!$role) {
            return redirect()->route('home')->with([
                'message' => "Role does not exist",
                'alert-type' => 'error'
            ]);
        }

        if (Auth::check() && Auth::user()->role_id == $role->id && Auth::user()->status == 1) {
            return $next($request);
        }

        return redirect()->route('home')->with([
            'message' => "Unauthorized access",
            'alert-type' => 'error'
        ]);
    }
}
