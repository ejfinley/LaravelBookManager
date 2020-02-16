<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;

/**
 * In the current version of the project 
 * it seems more beneficial to use 
 * features to test the api
 * and dusk to test e2e.
 * However this may change if 
 * non-api logic is needed.W
 */
class BooksTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testBasicTest()
    {
        $this->assertTrue(true);
    }
}
