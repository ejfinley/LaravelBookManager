<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

/**
 * This Test test the functionality of deleting a book 
 */
class DeleteBookTest extends DuskTestCase
{
    use DatabaseMigrations;
    public function setUp() : void
    {
        parent::setUp();
        $this->artisan('db:seed');
    }

    /**
     * This test the ability to delete a book
     * 
     * @return void
     */
    public function testDeleteBook()
    {

        $this->browse(function (Browser $browser) {
            //When I visit the home page
            $browser->visit('/') 
                    //When I click the delete button for Pride and Prejudice
                    ->click('@delete-button-1')
                    //I see a success message
                    ->assertSee('Book was successfully deleted')
                    // I no longer see Pride and prejudice
                    ->assertDontSee('Pride and Prejudice')
                    ->assertDontSee('Jane Austen')
                    // I can still see the other books
                    ->assertSee('Alice\'s Adventures in wonderland')
                    ->assertSee('Adventures of Tom Sawyer')
                    ->assertSee('Lewis Carroll')
                    ->assertSee('Mark Twain');
        });
    }
}