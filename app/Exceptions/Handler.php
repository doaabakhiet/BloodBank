<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;
use Illuminate\Auth\AuthenticationException;
class Handler extends ExceptionHandler
{
    /**
     * A list of exception types with their corresponding custom log levels.
     *
     * @var array<class-string<\Throwable>, \Psr\Log\LogLevel::*>
     */
    protected $levels = [
        //
    ];

    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<\Throwable>>
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed to the session on validation exceptions.
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
     *
     * @return void
     */
    public function register()
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }
    public function unauthunticated($request,AuthenticationException $exception){
        // return $request->expectsJson()
        // ? apiResponse(0,'UnAuthunticated',$request)
        // : redirect()->guest($exception->redirectTo()?? route('login'));

        if ($request->expectsJson()) {
            return apiResponse(0,'UnAuthunticated',$request);
        }

        if ($request->is('client') || $request->is('client/*')) {
            return redirect()->guest('/');
        }
        
        return redirect()->guest(route('/'));
    }
}
