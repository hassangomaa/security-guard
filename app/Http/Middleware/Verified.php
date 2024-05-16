<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class Verified
{
    public function handle(Request $request, Closure $next)
    {

        $user = \auth()->user();

        // Check if the user is authenticated and verified
        if ($user->email_verified_at == null) {
            return response()->json(
                [
                    "status" => "error",
                    "message" => "Account not verified"
                ]
            );
        }else
            return $next($request);
    }
}
