<?php

namespace App\Exceptions;

use App\Exceptions\Auth\InactiveUserException;
use App\Exceptions\Auth\InvalidTokenProvidedException;
use App\Exceptions\Auth\TokenExpiredException;
use App\Exceptions\Auth\TokenNotProvidedException;
use App\Exceptions\Auth\TooManyRequestsException;
use App\Helpers\Schema\FailSchema;
use Exception;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that should not be reported.
     *
     * @var array
     */
    protected $dontReport = [
        \Illuminate\Auth\AuthenticationException::class,
        \Illuminate\Auth\Access\AuthorizationException::class,
        \Symfony\Component\HttpKernel\Exception\HttpException::class,
        \Illuminate\Database\Eloquent\ModelNotFoundException::class,
        \Illuminate\Session\TokenMismatchException::class,
        \Illuminate\Validation\ValidationException::class,
    ];

    /**
     * Report or log an exception.
     *
     * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
     *
     * @param  \Exception $exception
     * @return void
     * @throws Exception
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
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $exception)
    {
        $this->logError($request, $exception);
        return parent::render($request, $exception);
    }

    /**
     * Convert an authentication exception into an unauthenticated response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Illuminate\Auth\AuthenticationException  $exception
     * @return \Illuminate\Http\Response
     */
    protected function unauthenticated($request, AuthenticationException $exception)
    {
        if ($request->expectsJson()) {
            return response()->json(['error' => 'Unauthenticated.'], 401);
        }

        return redirect()->guest(route('login'));
    }

    /**
     * Create a Symfony response for the given exception.
     *
     * @param  \Exception  $e
     * @return \Symfony\Component\HttpFoundation\Response
     */
    protected function convertExceptionToResponse(Exception $e)
    {
        $error = $this->createFailSchemaByException($e);

        if ($e instanceof RequestException) {
            $errors = $this->unserializeRequestErrors($e);
            $error->setErrors($errors);
            $error->setMessageCode($e->getMessageCode());
        }

        return response()
            ->json($error, $error->getStatusCode());
    }

    /**
     * @param Exception $e
     * @return FailSchema
     */
    private function createFailSchemaByException(\Exception $e)
    {
        $error = new FailSchema($e);

        if ($e instanceof TokenNotProvidedException) {
            $error->setMessage(\Lang::get('messages.token.notProvided'));
            $error->setMessageCode(\Lang::get('codes.token.notProvided'));
        } elseif ($e instanceof InvalidTokenProvidedException) {
            $error->setMessage(\Lang::get('messages.token.invalid'));
            $error->setMessageCode(\Lang::get('codes.token.invalid'));
        } elseif ($e instanceof InactiveUserException) {
            $error->setMessage(\Lang::get('messages.user.inactive'));
            $error->setMessageCode(\Lang::get('codes.user.inactive'));
        } elseif ($e instanceof TokenExpiredException) {
            $error->setMessage(\Lang::get('messages.token.expired'));
            $error->setMessageCode(\Lang::get('codes.token.expired'));
        } elseif ($e instanceof NotFoundHttpException) {
            $error->setMessage(\Lang::get('messages.error.http.notFound'));
            $error->setMessageCode(\Lang::get('codes.error.http.notFound'));
        } elseif ($e instanceof MethodNotAllowedHttpException) {
            $error->setMessage(\Lang::get('messages.error.http.methodNotAllowed'));
            $error->setMessageCode(\Lang::get('codes.error.http.methodNotAllowed'));
        } elseif ($e instanceof TooManyRequestsException) {
            $error->setMessage(\Lang::get('messages.token.manyAttempts', [
                'seconds' => $e->getTimeLeft()
            ]));
            $error->setMessageCode(\Lang::get('codes.token.manyAttempts'));
        } /*else {
            if (!$e instanceof RequestException) {
                $error->setMessage(\Lang::get('messages.error.unexpected'));
                $error->setMessageCode(\Lang::get('codes.error.unexpected'));
            }
        }*/

        return $error;
    }

    /**
     * @param Request $request
     * @param Exception $exception
     */
    private function logError(Request $request, $exception) : void
    {
        \Log::debug(get_class($exception), [
            'exception' => [
                'message' => $exception->getMessage(),
                'code' => $exception->getCode(),
                'file' => $exception->getFile(),
                'line' => $exception->getLine(),
                'errors' => ($exception instanceof RequestException)
                    ? $this->unserializeRequestErrors($exception) : []
            ],
            'request' => [
                'class' => get_class($request),
                'headers' => $request->header(),
                'route' => (!empty($request->route())) ? [
                    'name' => $request->route()->getName() ?? null,
                    'uri' => $request->route()->uri(),
                    'prefix' => $request->route()->getPrefix(),
                    'action' => $request->route()->getActionName(),
                    'method' => $request->route()->getActionMethod(),
                    'parameters' => $request->route()->parameterNames(),
                    'middleware' => $request->route()->gatherMiddleware(),
                    'httpOnly' => $request->route()->httpOnly(),
                ] : [],
                'json' => $request->json()->all() ?? [],
                'method' => $request->method(),
                'query' => $request->query(),
                'server' => $request->server()
            ]
        ]);
    }

    /**
     * @param RequestException $e
     * @return array
     */
    protected function unserializeRequestErrors(RequestException $e): array
    {
        $errorsUnserialized = [];

        foreach ($e->getErrors() as $errorSerialized) {
            $errorsUnserialized[] = unserialize($errorSerialized);
        }

        return $errorsUnserialized;
    }
}
