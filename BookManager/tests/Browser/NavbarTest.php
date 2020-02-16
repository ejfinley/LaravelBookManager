<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

/**
 * This Test test the functionality of the NavBar 
 * This includes functionality of the search bar
 */
class NavBarTest extends DuskTestCase
{
    use DatabaseMigrations;
    public function setUp() : void
    {
        parent::setUp();
        $this->artisan('db:seed');
    }

    /**
     * This checks See All Books Link
     * 
     * @return void
     */
    public function testNavigateToSeeAllBooks()
    {

        $this->browse(function (Browser $browser) {
            $browser->visit('/api/books/create')
                    ->clickLink("See All Books")
                    ->assertPathIs('/api/books');
            
        });
    }
    /**
     * This checks Add a Book link
     * 
     * @return void
     */
    public function testNavigateToAddABook()
    {

        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                    ->clickLink("Add a Book")
                    ->assertPathIs('/api/books/create');
            
        });
    }
    
    /**
     * Test search with one result
     * 
     * @return void
     */
    public function testSearchOneResult()
    {

        
        $this->browse(function (Browser $browser) {
            //When I visit the home page
            $browser->visit('/') 
                    //When I search for Jane
                    ->keys('#search', 'jane', '{enter}')
                    // Then I only see Pride and prejudice
                    ->assertSee('Pride and Prejudice')
                    ->assertSee('Jane Austen')
                    ->assertDontSee('Alice\'s Adventures in wonderland')
                    ->assertDontSee('Adventures of Tom Sawyer')
                    ->assertDontSee('Lewis Carroll')
                    ->assertDontSee('Mark Twain');
        });
    }
    /**
     * Test search with no result
     * 
     * @return void
     */
    public function testSearchNoResult()
    {
        $this->browse(function (Browser $browser) {
            //When I visit the home page
            $browser->visit('/') 
                    //When I search for Paul
                    ->keys('#search', 'paul', '{enter}')
                    // Then I should see no results
                    ->assertDontSee('Pride and Prejudice')
                    ->assertDontSee('Jane Austen')
                    ->assertDontSee('Alice\'s Adventures in wonderland')
                    ->assertDontSee('Adventures of Tom Sawyer')
                    ->assertDontSee('Lewis Carroll')
                    ->assertDontSee('Mark Twain');
        });
    }
    /**
     * Test search with multiple results
     * 
     * @return void
     */
    public function testSearchMultipleResults()
    {

        
        $this->browse(function (Browser $browser) {
            //When I visit the home page
            $browser->visit('/') 
                    //When I search for adventures
                    ->keys('#search', 'Adventures', '{enter}')
                    //  I should see Adventures of Tom Sawyer and Alice\'s Adventures in wonderland
                    ->assertDontSee('Pride and Prejudice')
                    ->assertDontSee('Jane Austen')
                    ->assertSee('Alice\'s Adventures in wonderland')
                    ->assertSee('Adventures of Tom Sawyer')
                    ->assertSee('Lewis Carroll')
                    ->assertSee('Mark Twain');
        });
    }

}
