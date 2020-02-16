<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Book;
//This test the http endpoint for Editing a book
class EditBooksTest extends TestCase
{
    //Test are run on an in memory sqlite database
    use refreshDatabase;
    /**
    * Test the endpoint GET /api/books/{book}/edit
    * This returns the form to edit a books author
    * @return void
    */
    public function testEdit()
    {
        //Given we have a book in the database
        $book = factory('App\Book')->create();
        // When the user visits the Add a Book page
        $response = $this->get('/api/books/' .$book->id. '/edit');
        //They should see the books title, An author input, and an update author button
        $response
            ->assertStatus(200)  
            ->assertSee('<button type="submit" class="btn btn-primary">Update Author</button>')
            ->assertSee('<input type="text" class="form-control" name="author" value="'.$book->author.'"/>')
            ->assertSee($book->title);
            
    }
    /**
    * Test the endpoint PUT /api/books/{book}
    * A book without a author is not updated
    * @return void
    */
    public function testUpdateNoAuthor()
    {
        //Given a book exist
        $book = factory('App\Book')->create();
        $author = $book -> author;
        // When the user Updates it with an empty author
        $book -> author ='      '; 
        $response = $this->put('/api/books/' .$book->id, $book -> toArray());
        //Then the author is not changed 
        $this->assertDatabaseMissing('books', $book-> toArray());
        $book -> author = $author; 
        $this->assertDatabaseHas('books', $book-> toArray());
    }
      /**
    * Test the endpoint PUT /api/books/{book}
    * A book is update
    * @return void
    */
    public function testUpdate()
    {
        //Given a book exist
        $book = factory('App\Book')->create();
        $author = $book -> author;
        // When the user updates with a new author
        $book -> author ='Updated Author'; 
        $response = $this->put('/api/books/' .$book->id, $book -> toArray());
        //Then the author has changed
        $this->assertDatabaseHas('books', $book-> toArray());
        //And the original author is no longer present
        $book -> author = $author; 
        $this->assertDatabaseMissing('books', $book-> toArray());
    }

}