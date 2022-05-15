<?php

namespace App\Exceptions;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        ApiPermissionDeniedException::class,
        ApiNotFoundException::class,
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
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

    public function render($request, Throwable $e)
    {
        if ($e instanceof ModelNotFoundException) {
            return response()->json(['message' => 'Entity not found'], 404);
        } else if ($e instanceof NotFoundHttpException) {
            return response()->json(['message' => 'Invalid Uri! No match any API route'], $e->getStatusCode());
        } else if ($e instanceof ApiNotFoundException) {
            return response()->json(['message' => $e->getMessage()], $e->getCode());
        } else if ($e instanceof ApiLogicalException) {
            return response()->json(['message' => $e->getMessage()], $e->getCode());
        } else if ($e instanceof ApiPermissionDeniedException) {
            return response()->json(['message' => $e->getMessage()], 403);
        } else if ($e instanceof QueryException) {
            return response()->json(['message' => $e->getMessage()], 422);
        }

        return parent::render($request, $e);
    }
}
