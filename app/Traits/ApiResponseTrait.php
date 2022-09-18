<?php

namespace App\Traits;

use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Http\Resources\Json\ResourceCollection;

trait ApiResponseTrait
{


    protected function respondSuccess($data, int $status_code, int $response_code): JsonResponse
    {
        return response()->json(
            [
                'status_code' => $status_code,
                'status' => 'success',
                'data' => $data,
            ],
            $response_code
        );
    }

    protected function respondWithMessage(int $status_code, int $response_code, string $message, $status = 'success', $data =  []): JsonResponse
    {
        return response()->json(
            [
                'status_code' => $status_code,
                'status' => $status,
                'message' => $message,
                'data' => $data,
            ],
            $response_code
        );
    }

    protected function respondValidationErrors(ValidationException $exception): JsonResponse
    {
        return  response()->json(
            [
                'status_code' => Response::HTTP_UNPROCESSABLE_ENTITY,
                'status' => 'false',
                'message' => 'Invalid data supplied',
                'errors' => $exception->errors()
            ],
            Response::HTTP_UNPROCESSABLE_ENTITY
        );
    }

    /**
     * Respond with not found.
     *
     * @param string $message
     *
     * @return JsonResponse
     */
    protected function respondNotFound(string $message = 'Not Found'): JsonResponse
    {
        return $this->apiResponse($message, 'false', Response::HTTP_NOT_FOUND);
    }


    protected function apiResponse(string $message, string $status, int $status_code): JsonResponse
    {
        return response()->json(
            [
                'status_code' => $status_code,
                'status' => $status,
                'message' => $message,
            ],
            $status_code
        );
    }

    /**
     * @param ResourceCollection $resourceCollection
     * @param string $status_message
     * @param int $status_code
     * @param int $response_code
     * @return JsonResponse
     */
    protected function respondWithResourceCollection(ResourceCollection $resourceCollection, string $status_message = 'success', int $status_code =  Response::HTTP_OK, int $response_code = Response::HTTP_OK): JsonResponse
    {

        return response()->json(
            [
                'status_code' => $status_code,
                'status' => $status_message,
                'data' => $resourceCollection,
            ],
            $response_code
        );
    }
}
