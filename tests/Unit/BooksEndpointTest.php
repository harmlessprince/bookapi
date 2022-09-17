<?php

namespace Tests\Unit;

use App\Models\Book;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;

class BooksEndpointTest extends TestCase
{
    use DatabaseMigrations, WithFaker;
    /**
     *
     * @return void
     */
    public function test_endpoint_for_getting_all_internal_books_can_be_reached()
    {
        $response = $this->get(route('books.index'));
        $response->assertStatus(200);
    }
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_endpoint_for_getting_a_single_internal_book_can_be_reached()
    {
        $book = Book::factory()->create();
        $response = $this->get(route('books.show', ['book' => $book->id]));
        $response->assertStatus(200);
    }
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_endpoint_for_creating_an_internal_book_can_be_reached()
    {
        $response = $this->post(route('books.store'), []);
        $response->assertStatus(200);
    }
     /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_endpoint_for_updating_an_internal_book_can_be_reached()
    {
        $book = Book::factory()->create();
        $response = $this->patch(route('books.update', ['book' => $book->id]), []);
        $response->assertStatus(200);
    }
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_endpoint_for_deleting_an_internal_book_can_be_reached()
    {
        $book = Book::factory()->create();
        $response = $this->delete(route('books.destroy', ['book' => $book->id]));
        $response->assertStatus(200);
    }
}
