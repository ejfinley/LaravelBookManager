<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

/**
 * This Test test the functionality of editing a book
 */
class EditBookTest extends DuskTestCase
{
    use DatabaseMigrations;
    public function setUp() : void
    {
        parent::setUp();
        $this->artisan('db:seed');
    }

    /**
     * This test the ability to edit a book 
     * 
     * @return void
     */
    public function testEditBook()
    {

        $this->browse(function (Browser $browser) {
            //When I visit the home page
            $browser->visit('/') 
                    //When I click the edit button for Pride and Prejudice
                    ->click('@edit-button-1');
            //I am navigated to the edit veiw
            $browser->assertPathIs('/api/books/1/edit')
                    // Then I input a new author
                    ->type('author', 'Updated Author')
                    ->click('updateAuthor');
            //I am navigated to the list veiw
            $browser->assertPathIs('/api/books')
                    //I see a sucess message
                    ->assertSee('Author was successfully updated')
                    // I see the new author and not the original
                    ->assertSee('Pride and Prejudice')
                    ->assertSee('Updated Author')
                    ->assertDontSee('Jane Austen')
                    // I can still see the other books
                    ->assertSee('Alice\'s Adventures in wonderland')
                    ->assertSee('Adventures of Tom Sawyer')
                    ->assertSee('Lewis Carroll')
                    ->assertSee('Mark Twain');
        });
    }
}