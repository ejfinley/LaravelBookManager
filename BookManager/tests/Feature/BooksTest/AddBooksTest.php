<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Book;
//This test the http endpoint for creating a book
class AddBooksTest extends TestCase
{
    //Test are run on an in memory sqlite database
    use refreshDatabase;
    /**
     * Test the endpoint GET /api/books/create
     * This returns a form to create a book
     * @return void
     */
    public function testCreate()
    {
        // When the user visits the Add a Book page
        $response = $this->get('/api/books/create');
        //They should see inputs for Title and author and the add button
        $response
            ->assertStatus(200)  
            ->assertSee('<button type="submit" class="btn btn-primary">Add</button>')
            ->assertSee('<input type="text" class="form-control" name="author"/>')
            ->assertSee('<input type="text" class="form-control" name="title"/>');
            
    }
    /**
     * Test the endpoint POST /api/books
     * This adds a book to the database
     * @return void
     */
    public function testStore()
    {
        $initialCount = Book::all()->count();
        // Given the user has a book
        $book = factory('App\Book')->make();
        // When the user stores their book 
        $response = $this->post('/api/books', $book->toArray());
        //The book is added to the database
        //There should be no errors and user is redirected to the index page
        $response->assertStatus(302)->assertRedirect('/api/books')->assertSessionHasNoErrors();
        //There is one more book in the database
        $this->assertEquals($initialCount + 1, Book::all()->count());
        $this->assertDatabaseHas('books', $book -> toArray());
            
    }
    /**
    * Test the endpoint POST /api/books
    * A book without a title is not stored
    * @return void
    */
    public function testStoreNoTitle()
    {
        $initialCount = Book::all()->count();
        // Given the user has a book
        $book = factory('App\Book')->make(['title' => null]);
        // When the user stores their book 
        $response = $this->post('/api/books', $book->toArray());
        //The book is NOT added to the database
        //There should be an error this error is on thr create page
        //It will be tested in e2e
        //The same number of books are in the database
        $this->assertEquals($initialCount, Book::all()->count());
        $this->assertDatabaseMissing('books',  $book -> toArray());    
            
    }
    /**
    * Test the endpoint POST /api/books
    * A book without a author is not stored
    * @return void
    */
    public function testStoreNoAuthor()
    {
        $initialCount = Book::all()->count();
        // Given the user has a book
        $book = factory('App\Book')->make(['author' => null]);
        // When the user stores their book 
        $response = $this->post('/api/books', $book->toArray());
        //The book is NOT added to the database
        //There should be an error this error is on thr create page
        //It will be tested in e2e
        //The same number of books are in the database
        $this->assertEquals($initialCount, Book::all()->count());
        $this->assertDatabaseMissing('books',  $book -> toArray());    
    }
}