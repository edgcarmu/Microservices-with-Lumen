<?php

namespace App\Traits;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

trait ApiResponder
{
    /**
     * Build a success response
     * @param $data
     * @param $code
     * @return Response
     */
    public function successResponse($data, $code = Response::HTTP_OK): Response
    {
        return response($data, $code)->header('Content-Type', 'application/json');
    }

    /**
     * Build a valid response
     * @param $data
     * @param int $code
     * @return JsonResponse
     */
    public function validResponse($data, $code = Response::HTTP_OK): JsonResponse
    {
        return response()->json(['data' => $data], $code);
    }

    /**
     * Build error responses
     * @param  $message
     * @param  $code
     * @return JsonResponse
     */
    public function errorResponse($message, $code): JsonResponse
    {
        return response()->json(['error' => $message, 'code' => $code], $code);
    }

    /**
     * Return an error in JSON format
     * @param  $message
     * @param  $code
     * @return Response
     */
    public function errorMessage($message, $code): Response
    {
        return response($message, $code)->header('Content-Type', 'application/json');
    }
}
