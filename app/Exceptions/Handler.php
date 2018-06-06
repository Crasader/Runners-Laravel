<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Noodlehaus\ErrorException;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
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
     * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
     *
     * @param  \Exception  $exception
     * @return void
     */
    public function report(Exception $exception)
    {
        Log::error(
            "RUNNERS LOG : " . get_class($exception) .
            " CODE : " . $exception->getCode() .
            " MESSAGE : " . $exception->getMessage(),
            ['REQUEST' => request()]
        );
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $exception
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $exception)
    {
        //dd($exception);
        if (config('app.debug')) {
            return parent::render($request, $exception);
        }
        if ($exception instanceof ModelNotFoundException) {
            return parent::render($request, $exception);
        }
        if ($exception instanceof NotFoundHttpException) {
            return parent::render($request, $exception);
        }
        if ($exception instanceof Exception) {
            return redirect()
                ->back()
                ->with('error', 'Une erreur non controlée est survenue. L\'administrateur a été informé');
        }
        return parent::render($request, $exception);
    }
}
