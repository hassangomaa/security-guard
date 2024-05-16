<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Auth\AuthenticationException;

class CustomHandler extends Exception
{
    public function render($request, Exception $exception)
    {
        if ($exception instanceof AuthenticationException) {
            if ($request->expectsJson()) {
                return response()->json(['error' => 'Unauthorized'], 401);
            }
        }

        return parent::render($request, $exception);
    }
}
