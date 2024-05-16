<?php

namespace App\Http\Middleware;

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
    public function handle(Request $request, Closure $next, string ...$guards): Response
    {
        $guards = empty($guards) ? [null] : $guards;
        // dd($guards);

        if (Auth::guard('api')->check()) {
            // Modify this part to return a JSON response
            return response()->json(['error' => 'APIYou are already authenticated.'], 401);
        } else if (Auth::guard('web')->check()) {
            // return redirect()->route('admin.show.login');
            return redirect()->route('admin.home');
        }

        // foreach ($guards as $guard) {
        //     if (Auth::guard($guard)->check()) {
        //         // Modify this part to return a JSON response
        //         return response()->json(['error' => 'You are already authenticated.'], 401);
        //     }
        // }

        return $next($request);
    }
}
