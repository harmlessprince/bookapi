<?php

namespace App\Exceptions;

use Throwable;
use App\Traits\ApiResponseTrait;
use Illuminate\Database\QueryException;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Exceptions\ThrottleRequestsException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;

class Handler extends ExceptionHandler
{
    use ApiResponseTrait;
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
    /**
     * Render an exception into an HTTP response.
     *
     * @param Request $request
     * @param Throwable $e
     *
     * @return Response
     *
     * @throws Throwable
     */
    public function render($request, Throwable $e): Response
    {
        if ($e instanceof ValidationException) {
            return $this->respondValidationErrors($e);
        }
        if ($e instanceof ModelNotFoundException) {
            $message = class_basename($e->getModel()) . ' not found';
            return $this->respondNotFound($message);
        }
        if ($e instanceof NotFoundHttpException) {
            return $this->respondNotFound('Route Not Found');
        }
        if ($e instanceof MethodNotAllowedHttpException) {
            return $this->apiResponse($e->getMessage(), 'fail', Response::HTTP_METHOD_NOT_ALLOWED);
        }
        if ($e instanceof QueryException) {
            return $this->apiResponse("There was Issue with the Query", "false",  Response::HTTP_INTERNAL_SERVER_ERROR);
        }
        if ($e instanceof ThrottleRequestsException) {
            return $this->apiResponse("Too many request, Please slow down", "fail", Response::HTTP_TOO_MANY_REQUESTS);
        }
        if ($e instanceof \Error) {
            return $this->apiResponse("There was some internal error", "false", Response::HTTP_INTERNAL_SERVER_ERROR);
        }
        return parent::render($request, $e);
    }
}
