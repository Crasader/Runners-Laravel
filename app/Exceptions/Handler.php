<?php

namespace App\Exceptions;

use App\User;
use Exception;
use Noodlehaus\ErrorException;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Notification;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Validation\ValidationException;
use Illuminate\Auth\Access\AuthorizationException;
use App\Notifications\UnHandledExceptionNotification;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        \Illuminate\Auth\AuthenticationException::class,
        \Illuminate\Auth\Access\AuthorizationException::class,
        \Symfony\Component\HttpKernel\Exception\HttpException::class,
        \Illuminate\Database\Eloquent\ModelNotFoundException::class,
        \Illuminate\Validation\ValidationException::class,
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
     * @throws Exception
     */
    public function report(Exception $exception)
    {
        // Log the exception in laravel.log
        Log::error(
            "RUNNERS LOG : " . get_class($exception) .
            " CODE : " . $exception->getCode() .
            " MESSAGE : " . $exception->getMessage(),
            ['REQUEST' => request()]
        );

        // Notify the app administrator (root)
        if (!config('app.debug')) {
            Notification::send([User::where('lastname','=', 'Carrel')->get()], new UnHandledExceptionNotification($exception));
        }
        // Call default exception reporter (displays mor detailed info's in the log)
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
        // In debug mode, call the default handler
        if (config('app.debug')) {
            return parent::render($request, $exception);
        }

        // Catch Http exeptions
        if ($exception instanceof ModelNotFoundException) {
            return parent::render($request, $exception);
        }
        if ($exception instanceof NotFoundHttpException) {
            return parent::render($request, $exception);
        }
        if ($exception instanceof HttpException) {
            return parent::render($request, $exception);
        }
        if ($exception instanceof AuthenticationException) {
            return parent::render($request, $exception);
        }
        if ($exception instanceof AuthorizationException) {
            return parent::render($request, $exception);
        }
        if ($exception instanceof ValidationException) {
            return parent::render($request, $exception);
        }

        // Return flash message for generic exeptions
        if ($exception instanceof Exception) {
            return redirect()
                ->back()
                ->with('error', 'Une erreur non controlée est survenue. L\'administrateur a été informé');
        }

        return parent::render($request, $exception);
    }
}
