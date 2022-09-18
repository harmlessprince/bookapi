<?php

namespace App\Http\Controllers;

use App\Http\Resources\BooksResourceCollection;
use App\Http\Resources\EmptyResource;
use App\Http\Resources\ExternalBookResource;
use App\Services\IceAndFireApiService;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Symfony\Component\HttpFoundation\Response;

class ExternalBookController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param Request $request
     * @return JsonResponse
     * @throws Exception
     */
    public function __invoke(Request $request): JsonResponse
    {
        try {
            $response = IceAndFireApiService::fetch();
            if (count($response->object()) < 1) {
                return $this->respondWithResourceCollection(EmptyResource::collection([]), 'not found', Response::HTTP_NOT_FOUND, Response::HTTP_NOT_FOUND);
            }else {
                return $this->respondWithResourceCollection(ExternalBookResource::collection($response->object()));
            }
        } catch (Exception $exception) {
            return $this->respondWithMessage(500, 500, $exception->getMessage(), 'fail');
        }

    }
}
