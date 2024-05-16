<?php

namespace App\Http\Middleware;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SetLocale
{
    public function handle($request, Closure $next)
    {
        $lang = null;

        if ($request->user()) {
            // Retrieve the user's language preference from the database
            $lang = $request->user()->lang;
        } else {
            // Retrieve the user's language preference from the session or any other storage
            $lang = env('APP_LOCALE', 'en');
        }

        if ($lang) {
            \App::setLocale($lang); // Update this line
        }

//        dd('SetLocale middleware executed');

        return $next($request);
    }
}
