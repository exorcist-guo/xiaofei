<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        BizException::class
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    /**
     * Report or log an exception.
     *
     * @param  \Exception  $exception
     * @return void
     *
     * @throws \Exception
     */
    public function report(Exception $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $exception
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @throws \Exception
     */
    public function render($request, Exception $exception)
    {
        if(!$request->expectsJson()) return parent::render($request, $exception);

        switch(true) {
            case $exception instanceof ModelNotFoundException:
                return response()->json([
                    'message' => 'Record not found',
                ], 404);
                break;
            case $exception instanceof NotFoundHttpException:
                return response()->json([
                    'message' => 'Page not found',
                ], 404);
                break;
            case $exception instanceof BizException:
                return response()->json(['code' => $exception->getCode(), 'msg' => $exception->getMessage()]);
                break;
            case $exception instanceof AuthenticationException:
                return response()->json(['code' => 40001, 'msg' => 'Unauthenticated.']);
                break;
        }

        return response()->json(['code' => 1, 'msg' => $exception->getMessage()]);
    }
}
