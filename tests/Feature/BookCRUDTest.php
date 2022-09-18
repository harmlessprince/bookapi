<?php

namespace Tests\Feature;

use App\Models\Book;
use Tests\TestCase;
use Database\Factories\BookFactory;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class BookCRUDTest extends TestCase
{
    use RefreshDatabase, WithFaker;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_a_book_can_not_be_created_without_supplying_required_fields(): void
    {
        $response = $this->post(route('books.store'), []);
        $response->assertStatus(422);
    }
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_a_book_can_be_created_by_supplying_required_fields(): void
    {
        $bookFactory = new BookFactory();
        $data = $bookFactory->definition();
        $response = $this->post(route('books.store'), $data);
        $this->assertDatabaseCount('books', 1);
        $response->assertStatus(201);
    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_a_book_can_be_updated_by_supplying_data(): void
    {
        $book = Book::factory()->create();
        sleep(0.5);
        $response = $this->patch(route('books.update', ['book' => $book->id]), ['name' => "Updated book with new name"]);
        $this->assertDatabaseHas('books', ["name" => "Updated book with new name"]);
        $response->assertStatus(200);
    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_a_book_can_not_be_updated_by_if_invalid_book_id_is_supplied(): void
    {
        $response = $this->patch(route('books.update', ['book' => 10000]), ['name' => "Updated book with new name"]);
        $response->assertStatus(404);
    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_a_book_can_be_viewed_by_supplying_a_book_id(): void
    {
        $book = Book::factory()->create();
        $response = $this->get(route('books.show', ['book' => $book->id]));
        $response->assertStatus(200);
    }
    public function test_a_book_that_does_not_exists_can_not_viewed_by_supplying_a_book_id()
    {
        $response = $this->get(route('books.show', ['book' => 1000]));
        $response->assertStatus(404);
    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_a_book_can_be_deleted_by_supplying_a_valid_book_id(): void
    {
        $book = Book::factory()->create();
        $response = $this->delete(route('books.destroy', ['book' => $book->id]));
        $this->assertDatabaseMissing('books', ['id' => $book->id]);
        $response->assertStatus(200);
    }
}
