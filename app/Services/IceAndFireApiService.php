<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

use function PHPUnit\Framework\throwException;

class IceAndFireApiService
{
    private $baseUrl = 'https://www.anapioficeandfire.com/api/books';
    public function fetch($name)
    {

        try {
            $query = $this->buildQuery();
            // if ($name != null && $name != '') {
            //     $query = array_merge($query, ['name' => $name]);
            // }
            return Http::acceptJson()->get($this->baseUrl, $query);
        } catch (\Throwable $th) {
            throwException($th);
        }
    }
    
    private function buildQuery()
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
