<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Book;
//This test the http endpoint for deleting a book
class DeleteBooksTest extends TestCase
{
    //Test are run on an in memory sqlite database
    use refreshDatabase;
    /**
     * Test the endpoint DELETE /api/books
     * This removes a book from the database
     * @return void
     */
    public function testDelete()
    {  
        // Given A book exist
        $book = factory('App\Book')->create();
        $initialCount = Book::all()->count();
        // When the user deletes that book
        $response = $this->delete('/api/books/'. $book->id);
        //The book is removed from the database
        //There should be no errors and user is redirected to the index page
        $response->assertStatus(302)->assertRedirect('/api/books')->assertSessionHasNoErrors();
        //There is one less book in the database
        $this->assertEquals($initialCount - 1, Book::all()->count());
        $this->assertDatabaseMissing('books', $book -> toArray());
            
    }
}