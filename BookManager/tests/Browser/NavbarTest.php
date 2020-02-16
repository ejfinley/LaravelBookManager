<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

/**
 * This Test test the functionality of the NavBar 
 * 
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
}
