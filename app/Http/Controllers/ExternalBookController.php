<?php

namespace App\Http\Controllers;

use App\Http\Resources\BooksResourceCollection;
use App\Http\Resources\EmptyResource;
use App\Http\Resources\ExternalBookResource;
use App\Services\IceAndFireApiService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ExternalBookController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request, IceAndFireApiService $iceAndFireApiService)
    {
        $response = $iceAndFireApiService->fetch($request->name);
        if ($response->failed()) {
            return $this->respondWithMessage(500, 500, 'We could not make connection to the api, try again later', 'fail');
        }
        if (count($response->object()) < 1) {
            return $this->respondWithResourceCollection(EmptyResource::collection([]), 'not found', 404);
        }
        return $this->respondWithResourceCollection(ExternalBookResource::collection($response->object()));
    }
}
