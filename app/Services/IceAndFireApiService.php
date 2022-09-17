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
            $query = [];
            if ($name != null && $name != '') {
                $query = array_merge($query, ['name' => $name]);
            }
            return Http::acceptJson()->get($this->baseUrl, $query);
        } catch (\Throwable $th) {
            throwException($th);
        }
    }
}
