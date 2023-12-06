<?php

namespace App\Exceptions;

use Throwable;
use Illuminate\Http\Response;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Exceptions\ThrottleRequestsException as ThrottleException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;

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
        if ($exception instanceof ThrottleException) return response()->json(['message'=> $exception->getMessage()], Response::HTTP_TOO_MANY_REQUESTS);

        if ($exception instanceof ModelNotFoundException){
            $class = class_basename($exception->getModel());
        } return response()->json(["message" => $class. " not found","code"=>404 ], Response::HTTP_NOT_FOUND); 

        if ($exception instanceof AuthorizationException) return response()->json(['error' => 'Unauthorized'], Response::HTTP_FORBIDDEN);

        
        
        return parent::render($request, $exception);
        
    }
}
