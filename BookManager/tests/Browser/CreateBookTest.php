<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

/**
 * This Test test the functionality of creating a book
 */
class CreateBookTest extends DuskTestCase
{
    use DatabaseMigrations;
    public function setUp() : void
    {
        parent::setUp();
        $this->artisan('db:seed');
    }

    /**
     * Test creating a valid book
     * 
     * @return void
     */
    public function testCreateBook()
    {
        $this->browse(function (Browser $browser) {
            //Make a book to add        
            $book = factory('App\Book')->make();
            //Navigate to the create page and send the data
            $browser->visit('/api/books/create')
                ->type('title', $book->title)
                ->type('author', $book->author)
                ->press('Add');
            //Check we are redirected to home page with no errors.
            $browser->pause(500);
            $browser->assertPathIs('/api/books')->assertSee('Book was successfully saved');
            //Check the new book is displayed
            $browser 
                ->assertSee($book->title)
                ->assertSee($book->author);

        });

    }
    /**
     * Test creating a book with no author
     * 
     * @return void
     */
    public function testNullAuthor()
    {
        $this->browse(function (Browser $browser) {
            //Make a book to add        
            $book = factory('App\Book')->make();
            $book -> author = '         '; 
            //Navigate to the create page and send the data
            $browser->visit('/api/books/create')
                ->type('title', $book->title)
                ->type('author', $book->author)
                ->press('Add');
            //Check we remain on the same page and an error is displayed.
            $browser->pause(500);
            $browser->assertPathIs('/api/books/create')->assertSee('The author field is required.');

            //Check the new book is not displayed
            $browser->visit('/api/books')
                ->assertDontSee($book->title);

        });

    }
      /**
     * Test creating a book with no title
     * 
     * @return void
     */
    public function testNullTitle()
    {
        $this->browse(function (Browser $browser) {
            //Make a book to add        
            $book = factory('App\Book')->make();
            $book -> title = '         '; 
            //Navigate to the create page and send the data
            $browser->visit('/api/books/create')
                ->type('title', $book->title)
                ->type('author', $book->author)
                ->press('Add');
            //Check we remain on the same page and an error is displayed.
            $browser->pause(500);
            $browser->assertPathIs('/api/books/create')->assertSee('The title field is required.');

            //Check the new book is not displayed
            $browser->visit('/api/books')
                ->assertDontSee($book->author);

        });

    }
}