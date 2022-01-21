<?php

namespace App\Http\Middleware;

use App\Models\Role;
use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class AuthGate
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $user = auth()->user();


        if (!app()->runningInConsole() && $user) {

            $roles            = Role::with('permissions')->get();

            $permissionsArray = [];

            foreach ($roles as $role) {
                foreach ($role->permissions as $permissions) {
                    $permissionsArray[$permissions->permission][] = $role->id;
                }
            }
            foreach ($permissionsArray as $permissions => $roles) {
                Gate::define($permissions, function (\App\Models\User $user) use ($roles) {
                    return count(array_intersect($user->roles()->pluck('id')->toArray(), $roles)) > 0;
                });
            }
        }
        return $next($request);
    }
}
