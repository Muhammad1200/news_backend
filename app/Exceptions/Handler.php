<?php

namespace App\Exceptions;

use App\Http\Controllers\Api\Controller as ResponseController;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<Throwable>>
     */
    protected $dontReport = [
        \Illuminate\Auth\AuthenticationException::class,
        \Illuminate\Auth\Access\AuthorizationException::class,
        \Symfony\Component\HttpKernel\Exception\HttpException::class,
        \Illuminate\Database\Eloquent\ModelNotFoundException::class,
        \Illuminate\Session\TokenMismatchException::class,
        \Illuminate\Validation\ValidationException::class
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
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

        $this->renderable(function (\Exception $exception, $request) {
            if ($request->is('api/*')) {
                $response = new ResponseController();

                if ($exception instanceof MethodNotAllowedHttpException) {
                    return $response
                        ->setStatusCode($exception->getCode())
                        ->respondMethodNotAllowed([$exception->getMessage()]);
                }

                if ($exception instanceof ModelNotFoundException) {
                    return $response
                        ->setStatusCode($exception->getCode())
                        ->respondWithError(
                            [
                                $exception->getMessage()
                            ],
                            false,
                            'Not Found!'
                        );
                }

                if ($exception instanceof NotFoundHttpException) {
                    return $response
                        ->setStatusCode($exception->getCode())
                        ->respondWithError(
                            [
                                $exception->getMessage()
                            ],
                            false,
                            'Not Found!'
                        );
                }

                if ($exception instanceof AuthenticationException) {
                    return $response
                        ->setStatusCode(401)
                        ->respondWithError(
                            $exception->getMessage(),
                            false,
                            $exception->getMessage()
                        );
                }
            }
        });

    }
}
