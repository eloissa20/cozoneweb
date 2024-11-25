<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$guards)
    {
        // $guards = empty($guards) ? [null] : $guards;

        // foreach ($guards as $guard) {
        //     if (Auth::guard($guard)->check()) {
        //         return redirect(RouteServiceProvider::HOME);
        //     }
        // }

        // return $next($request);

        if (Auth::check()) {
            // Redirect based on the user's role
            switch (Auth::user()->user_type) {
                case 1:
                    return redirect()->route('client_side.home');
                case 2:
                    return redirect()->route('coworker_side.coworker');
                case 3:
                    return redirect()->route('admin_side.admin');
                default:
                    // Handle unexpected user type if necessary
                    return redirect()->route('home'); // Redirect to a default route
            }
        }

        // If not authenticated, continue with the request
        return $next($request);
    }
}