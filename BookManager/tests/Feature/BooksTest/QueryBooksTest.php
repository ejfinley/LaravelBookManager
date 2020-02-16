<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Book;
//This test the http endpoints of the Book api
//The query books function
class QueryBooksTest extends TestCase
{
    //Test are run on an in memory sqlite database
    use refreshDatabase;

    /**
     * Test the endpoint GET /api/books/query
     * This returns all books in the database
     * meeting a search string
     * @return void
     */
    public function testQueryByAuthor()
    {
        //Given we have books in the database
        $book = factory('App\Book')->create();
        $bookTwo = factory('App\Book')->create();
        $bookThree = factory('App\Book')->create();
        // When the user searches an author of one book
        $response = $this->get('/api/books/query?search=' . $book -> author);
        //Then I should see only the searche author
        $response
            ->assertStatus(200)  
            ->assertSee($book->title)
            ->assertSee($book->author)
            ->assertDontSee($bookTwo->title)
            ->assertDontSee($bookTwo->author)
            ->assertDontSee($bookThree->title)
            ->assertDontSee($bookThree->author);
            
    }
      /**
     * Test the endpoint GET /api/books/query
     * This returns all books in the database
     * meeting a search string
     * @return void
     */
    public function testQueryByTitle()
    {
        //Given we have books in the database
        $book = factory('App\Book')->create();
        $bookTwo = factory('App\Book')->create();
        $bookThree = factory('App\Book')->create();
        // When the user searches an author of one book
        $response = $this->get('/api/books/query?search=' . $book -> title);
        //Then I should see only the searche author
        $response
            ->assertStatus(200)  
            ->assertSee($book->title)
            ->assertSee($book->author)
            ->assertDontSee($bookTwo->title)
            ->assertDontSee($bookTwo->author)
            ->assertDontSee($bookThree->title)
            ->assertDontSee($bookThree->author);
            
    }

}
