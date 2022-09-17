<?php

namespace App\Traits;

use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Http\Resources\Json\ResourceCollection;

trait ApiResponseTrait
{


    protected function respondSuccess($data, int $status_code)
    {
        return response()->json(
            [
                'status_code' => $status_code,
                'status' => 'success',
                'data' => $data,
            ],
            $status_code
        );
    }

    protected function respondWithMessage(int $status_code, int $response_code ,$message, $status = 'success', $data =  [])
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


    protected function apiResponse(string $message, string $status, int $status_code)
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
     * @param null $message
     * @param int $statusCode
     * @param array $headers
     * @return JsonResponse
     */
    protected function respondWithResourceCollection(ResourceCollection $resourceCollection): JsonResponse
    {

        return response()->json(
            [
                'status_code' => 200,
                'status' => 'success',
                'data' => $resourceCollection,
            ],
            200
        );
    }
}
