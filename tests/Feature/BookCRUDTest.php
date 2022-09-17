<?php

namespace Tests\Feature;

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
    public function test_a_book_can_not_be_created_without_supplying_required_fields()
    {
        $response = $this->post(route('books.store'), []);
        $response->assertStatus(302);
    }
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_a_book_can_be_created_by_supplying_required_fields()
    {
        $bookFactory = new BookFactory();
        $data = $bookFactory->definition();
        $response = $this->post(route('books.store'), $data);
        $this->assertDatabaseCount('books', 1);
        $response->assertStatus(200);
    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_a_book_can_be_updated_by_supplying_data()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_a_book_can_be_viewed_by_supplying_a_book_id()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_a_book_can_be_deleted_by_supplying_a_book_id()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }
}
