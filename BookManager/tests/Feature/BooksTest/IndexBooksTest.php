<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Book;
//This test the http endpoints of the Book api
//The Index all books
class IndexBooksTest extends TestCase
{
    //Test are run on an in memory sqlite database
    use refreshDatabase;

    /**
     * Test the endpoint GET /api/books
     * This returns all books in the database
     * @return void
     */
    public function testGetAllBooks()
    {
        //Given we have books in the database
        $book = factory('App\Book')->create();
        $bookTwo = factory('App\Book')->create();
        // When the user visits the index page
        $response = $this->get('/api/books');
        //They should see the books Titles and authors
        $response
            ->assertStatus(200)  
            ->assertSee($book->title)
            ->assertSee($book->author)
            ->assertSee($bookTwo->title)
            ->assertSee($bookTwo->author);
            
    }
    /**
     * Test the base url redirects to index
     *
     * @return void
     */
    public function testIndexRedirect()
    {
        $response = $this->get('/');

        $response->assertStatus(302);
    }

}
