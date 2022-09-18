<?php

namespace Tests\Feature;

use App\Services\IceAndFireApiService;
use Exception;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Http;
use Illuminate\Testing\Fluent\AssertableJson;
use JetBrains\PhpStorm\NoReturn;
use Tests\TestCase;

class ExternalBookApiTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     * @throws Exception
     */
    public function test_it_returns_a_collection_of_books(): void
    {
        Http::preventStrayRequests();
        Http::fake([
            IceAndFireApiService::baseUrl => Http::response([
                [
                    'name' => 'A Game of Thrones',
                    'isbn' => '978-0553103540',
                    'authors' => ["George R. R. Martin"],
                    'numberOfPages' => 694,
                    'publisher' => 'Bantam Books',
                    'country' => 'United States'
                ]
            ], 200)
        ]);
        $response = IceAndFireApiService::fetch();
        $books = $response->json();
        $this->assertIsIterable($books);
        $this->assertCount(1, $books);
    }

    /**
     * A basic feature test example.
     *
     * @return void
     * @throws Exception
     */
    public function test_it_returns_expected_properties(): void
    {
        Http::preventStrayRequests();
        Http::fake([
            IceAndFireApiService::baseUrl => Http::response([
                [
                    'name' => 'A Game of Thrones',
                    'isbn' => '978-0553103540',
                    'authors' => ["George R. R. Martin"],
                    'numberOfPages' => 694,
                    'publisher' => 'Bantam Books',
                    'country' => 'United States',
                    'released' => '1995-06-09'
                ]
            ], 200)
        ]);
        // Now we can make our assertions that the endpoint will provide us with the data we expect
        $this->json('get', route('external-books'))
            ->assertOk()
            ->assertJson(fn(AssertableJson $json) => $json->has('status_code')->has('status')
                ->has('data.0', fn($json) => $json->where('name', 'A Game of Thrones')
                    ->where('isbn', '978-0553103540')
                    ->where('authors', ["George R. R. Martin"])
                    ->where('number_of_pages', 694)
                    ->where('publisher', 'Bantam Books')
                    ->where('release_date', '1995-06-09')
                    ->etc()
                )->etc()
            );
    }

    /**
     * A basic feature test example.
     *
     * @return void
     * @throws Exception
     */
    public function test_it_returns_expected_properties_when_no_data_is_found(): void
    {
        $this->withExceptionHandling();
        Http::preventStrayRequests();
        $url = IceAndFireApiService::baseUrl . "?name=Bat";
        Http::fake([
            $url => Http::response([], 404)
        ]);
        // Now we can make our assertions that the endpoint will provide us with the data we expect
        $this->json('get', route('external-books', ['name' => "Bat"]))
            ->assertStatus(404)
            ->assertJson(fn(AssertableJson $json) => $json->has('status_code')->has('status')
                ->where('status_code', 404)
                ->missing('data.0')->etc()
            );
    }
}
