<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Http\Exceptions\ThrottleRequestsException;

use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;

class Handler extends ExceptionHandler
{
    /**
     * The list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     */
    public function register(): void
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    public function render($request, Throwable $exception)
    {
        // if ($request->is('api/*')) {
        if ($exception instanceof AuthenticationException) {
            if ($request->is('api/*')) {
                return response()->json(['error' => 'Unauthenticated'], 401);
            } else {
                return redirect()->route('admin.login');
            }
        }
        if ($exception instanceof ThrottleRequestsException) {
            return response()->json([
                'error' => 'Too Many Requests',
                'message' => $exception->getMessage(),
            ], 429);
        }
        if ($exception instanceof UnauthorizedHttpException) {
            return response()->json([
                'error' => 'Unauthorized',
                'message' => 'Unauthorized access',
            ], 401);
        }
        // }

        // Add a default return statement
        return parent::render($request, $exception);
    }
}
