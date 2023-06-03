<?php

namespace App\Exceptions;

use Throwable;
use App\Enums\ResponseEnum;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use App\Traits\HandleApiResponseTrait;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Validation\UnauthorizedException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Exceptions\ThrottleRequestsException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;

class Handler extends ExceptionHandler
{
    use HandleApiResponseTrait;

    protected $levels = [
        //
    ];

    protected $dontReport = [
        //
    ];

    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    public function register()
    {
        $this->reportable(function (Throwable $e) {
        });

        $this->renderable(function (NotFoundHttpException $e, $request) {
            if ($request->is('api/*')) {
                return $this::sendFailedResponse(ResponseEnum::MODEL_DATA_NOT_FOUND->name);
            }
        });

        $this->renderable(function (ThrottleRequestsException $e, $request) {
            if ($request->is('api/*')) {
                return $this::sendFailedResponse(ResponseEnum::TOO_MANY_ATTEMPTS->name);
            }
        });
    }

    public function render($request, Throwable $exception)
    {
        if ($exception instanceof \Spatie\Permission\Exceptions\UnauthorizedException) {
            return response()->json(['status' => false, 'code' => 403, 'message' => 'unauthorized_action', 'data' => null, 'errors' => null])->setStatusCode(403);
        }

        return parent::render($request, $exception);
    }

    protected function unauthenticated($request, AuthenticationException $exception): JsonResponse|Response|RedirectResponse
    {
        return $this->shouldReturnJson($request, $exception)
            ? response()->json([
                'success' => false,
                'code' => Response::HTTP_UNAUTHORIZED,
                'message' => __('You have been logout, please login again'),
                'direct' => 'login',
                'data' => [],
            ], Response::HTTP_UNAUTHORIZED)
            : redirect()->guest($exception->redirectTo() ?? route('admin.login'));
    }

    protected function invalidJson($request, ValidationException $exception): JsonResponse
    {
        return response()->json([
            'success' => false,
            'code' => $exception->status,
            'message' => $exception->getMessage(),
            'errors' => $exception->errors(),
            'direct' => null,
        ], $exception->status);
    }
}
