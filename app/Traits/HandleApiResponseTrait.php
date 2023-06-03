<?php

namespace App\Traits;

use App\Enums\ResponseEnum;
use Illuminate\Http\JsonResponse;
use \Symfony\Component\HttpFoundation\Response;

trait HandleApiResponseTrait
{
    public static function sendSuccessResponse($data = [], ?string $message = null, int $code = Response::HTTP_OK, $direct = null): JsonResponse
    {
        return response()->json([
            'success' => true,
            'code' => $code,
            'message' => $message ?? ResponseEnum::SUCCESS_RESPONSE->name,
            'direct' => $direct,
            'data' => $data,
        ], $code);
    }

    public static function sendFailedResponse($message = null, int $code = Response::HTTP_NOT_FOUND, $direct = null): JsonResponse
    {
        if ($code == Response::HTTP_PAYMENT_REQUIRED) {
            $direct = 'points_screen';
        }

        return response()->json([
            'success' => false,
            'code' => $code,
            'message' => $message ?? ResponseEnum::FAILED_RESPONSE->name,
            'direct' => $direct,
            'data' => [],
        ], $code);
    }
}
