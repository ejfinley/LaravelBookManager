<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

/**
 * This Test test the functionality of displaying 
 * the book list
 */
class IndexTest extends DuskTestCase
{
    use DatabaseMigrations;
    public function setUp() : void
    {
        parent::setUp();
        $this->artisan('db:seed');
    }

    /**
     * This checks the display of the index table
     * 
     * @return void
     */
    public function testBookTable()
    {

        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                    ->assertSee('Pride and Prejudice')
                    ->assertSee('Alice\'s Adventures in wonderland')
                    ->assertSee('Adventures of Tom Sawyer')
                    ->assertSee('Jane Austen')
                    ->assertSee('Lewis Carroll')
                    ->assertSee('Mark Twain');
        });
    }
}