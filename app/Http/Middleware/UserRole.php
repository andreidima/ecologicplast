<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

use Auth;

class UserRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, ... $roles)
    {
        if (!Auth::check()) // I included this check because you have it, but it really should be part of your 'auth' middleware, most likely added as part of a route group.
            return redirect('login');

        $user = Auth::user();

        // dd($user, $user->role, $roles);
        if($user->role == 'superadmin')
            return $next($request);

        foreach($roles as $role) {
            // Check if user has the role This check will depend on how your roles are set up
            if($user->role == $role)
                return $next($request);
        }

        return redirect('login');
    }
}


