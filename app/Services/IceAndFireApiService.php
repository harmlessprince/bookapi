<?php

namespace App\Services;

use Exception;

use GuzzleHttp\Promise\PromiseInterface;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;

class IceAndFireApiService
{
    const baseUrl = 'https://www.anapioficeandfire.com/api/books';

    /**
     * @throws Exception
     */
    public static function fetch(): PromiseInterface|Response
    {
        try {
            $query = self::buildQuery();
            return Http::accept('application/vnd.anapioficeandfire+json; version=1')->get(self::baseUrl, $query);
        } catch (\Throwable $th) {
            throw new Exception($th->getMessage(), 1);
        }
    }

    private static function buildQuery(): array
    {
        $query = [];
        $name = request('name');
        $page = request('page');
        $pageSize = request('pageSize');
        if ($name != null && $name != '') {
            $query = array_merge($query, ['name' => $name]);
        }
        if ($page != null && $page != '') {
            $query = array_merge($query, ['page' => $page]);
        }

        if ($pageSize != null && $pageSize != '') {
            $query = array_merge($query, ['pageSize' => $pageSize]);
        }
        return $query;
    }
}
