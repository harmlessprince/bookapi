<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Support\Facades\Schema;

class BookTableTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * A test to check if books table.
     *
     * @return void
     */
    public function test_books_table_has_expected_columns()
    {
        $this->assertTrue(
            Schema::hasColumns(
                'books',
                [
                    'id', 'name', 'isbn', 'authors', 'country', 'number_of_pages', 'publisher', 'release_date'
                ]
                )
        );
    }
}
