<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Auth;

class RoleCheck
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next, $roles)
    {
        if (Auth::check()) {
            $user = Auth::user();
            $role = explode('|', $roles);
            $count = count($role);

            if ($count > 1) {
                if (in_array($user->rank, $role)) {
                    return $next($request);
                }
            }elseif ($count == 1) {
                if ($user->rank == 2) {
                    return $next($request);
                }
            }
            return redirect(RouteServiceProvider::HOME);
        }

        return redirect(RouteServiceProvider::HOME);
    }
}
